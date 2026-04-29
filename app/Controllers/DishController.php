<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Dish;

class DishController extends Controller {

    // Show add dish form
    public function create() {
        $user = requireAuth();
        if ($user['role'] !== 'chef') {
            header("Location: " . url('/dashboard'));
            exit;
        }
        $this->view('dishes/create.php', ['user' => $user]);
    }

    // Handle add dish form submission
    public function store() {
        checkCsrf();
        $user = requireAuth();
        if ($user['role'] !== 'chef') {
            header("Location: " . url('/dashboard'));
            exit;
        }

        $title        = trim($_POST['title'] ?? '');
        $description  = trim($_POST['description'] ?? '');
        $price        = (float) ($_POST['price'] ?? 0);
        $category     = trim($_POST['category'] ?? '');
        $availability = isset($_POST['availability']) ? 1 : 0;
        $stock        = (int) ($_POST['stock'] ?? 0);
        $image        = '';

        // Validation
        if (!$title || !$price) {
            Session::set('error', 'Title and price are required.');
            header("Location: " . url('/dishes/create'));
            exit;
        }

        // Handle image upload
        if (!empty($_FILES['image']['name'])) {
            $ext      = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $allowed  = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array(strtolower($ext), $allowed)) {
                Session::set('error', 'Only JPG, PNG and WEBP images are allowed.');
                header("Location: " . url('/dishes/create'));
                exit;
            }

            $filename = uniqid('dish_') . '.' . $ext;
            $dest     = __DIR__ . '/../../uploads/dishes/' . $filename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
                $image = $filename;
            }
        }

        Dish::create([
            'chef_id'      => $user['id'],
            'title'        => $title,
            'description'  => $description,
            'price'        => $price,
            'image'        => $image,
            'category'     => $category,
            'availability' => $availability,
            'stock'        => $stock,
        ]);

        Session::set('success', 'Dish added successfully!');
        header("Location: " . url('/dishes'));
        exit;
    }

    // List chef's dishes
    public function index() {
        $user   = requireAuth();
        if ($user['role'] !== 'chef') {
            header("Location: " . url('/dashboard'));
            exit;
        }
        $dishes = Dish::findByChef($user['id']);
        $this->view('dishes/index.php', ['user' => $user, 'dishes' => $dishes]);
    }

    // Show edit form
    public function edit() {
        $user = requireAuth();
        $id   = (int) ($_GET['id'] ?? 0);
        $dish = Dish::findById($id);

        if (!$dish || $dish['chef_id'] !== $user['id']) {
            Session::set('error', 'Dish not found.');
            header("Location: " . url('/dishes'));
            exit;
        }

        $this->view('dishes/edit.php', ['user' => $user, 'dish' => $dish]);
    }

    // Handle edit form submission
    public function update() {
        checkCsrf();
        $user = requireAuth();
        $id   = (int) ($_POST['id'] ?? 0);
        $dish = Dish::findById($id);

        if (!$dish || $dish['chef_id'] !== $user['id']) {
            Session::set('error', 'Dish not found.');
            header("Location: " . url('/dishes'));
            exit;
        }

        $title        = trim($_POST['title'] ?? '');
        $description  = trim($_POST['description'] ?? '');
        $price        = (float) ($_POST['price'] ?? 0);
        $category     = trim($_POST['category'] ?? '');
        $availability = isset($_POST['availability']) ? 1 : 0;
        $stock        = (int) ($_POST['stock'] ?? 0);
        $image        = $dish['image'];

        // Handle new image upload
        if (!empty($_FILES['image']['name'])) {
            $ext     = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array(strtolower($ext), $allowed)) {
                Session::set('error', 'Only JPG, PNG and WEBP images are allowed.');
                header("Location: " . url('/dishes/edit?id=' . $id));
                exit;
            }

            $filename = uniqid('dish_') . '.' . $ext;
            $dest     = __DIR__ . '/../../uploads/dishes/' . $filename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
                // Delete old image
                if ($dish['image']) {
                    @unlink(__DIR__ . '/../../uploads/dishes/' . $dish['image']);
                }
                $image = $filename;
            }
        }

        Dish::update($id, [
            'title'        => $title,
            'description'  => $description,
            'price'        => $price,
            'image'        => $image,
            'category'     => $category,
            'availability' => $availability,
            'stock'        => $stock,
        ]);

        Session::set('success', 'Dish updated successfully!');
        header("Location: " . url('/dishes'));
        exit;
    }

    // Delete dish
    public function destroy() {
        checkCsrf();
        $user = requireAuth();
        $id   = (int) ($_POST['id'] ?? 0);
        $dish = Dish::findById($id);

        if (!$dish || $dish['chef_id'] !== $user['id']) {
            Session::set('error', 'Dish not found.');
            header("Location: " . url('/dishes'));
            exit;
        }

        // Delete image file
        if ($dish['image']) {
            @unlink(__DIR__ . '/../../uploads/dishes/' . $dish['image']);
        }

        Dish::delete($id);
        Session::set('success', 'Dish deleted successfully!');
        header("Location: " . url('/dishes'));
        exit;
    }
}
<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Dish;

require_once __DIR__ . '/../../config/database.php';

class CustomerController extends Controller {

    // Browse all available dishes
    public function browse() {
        $user   = requireAuth();
        if ($user['role'] !== 'customer') {
            header("Location: " . url('/chef-dashboard'));
            exit;
        }
        $dishes = Dish::all();
        $this->view('customer/browse.php', ['user' => $user, 'dishes' => $dishes]);
    }

    // View single dish
    public function dish() {
        $user = requireAuth();
        $id   = (int) ($_GET['id'] ?? 0);
        $dish = \App\Models\Dish::findById($id);

        if (!$dish) {
            Session::set('error', 'Dish not found.');
            header("Location: " . url('/browse'));
            exit;
        }

        $this->view('customer/dish.php', ['user' => $user, 'dish' => $dish]);
    }

    // View cart
    public function cart() {
        $user = requireAuth();
        if ($user['role'] !== 'customer') {
            header("Location: " . url('/chef-dashboard'));
            exit;
        }
        $cart  = Session::get('cart') ?? [];
        $total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
        $this->view('customer/cart.php', ['user' => $user, 'cart' => $cart, 'total' => $total]);
    }

    // Add to cart
    public function addToCart() {
        $user    = requireAuth();
        $dish_id = (int) ($_POST['dish_id'] ?? 0);
        $dish    = \App\Models\Dish::findById($dish_id);

        if (!$dish) {
            Session::set('error', 'Dish not found.');
            header("Location: " . url('/browse'));
            exit;
        }

        $cart = Session::get('cart') ?? [];

        if (isset($cart[$dish_id])) {
            $cart[$dish_id]['quantity']++;
        } else {
            $cart[$dish_id] = [
                'id'        => $dish['id'],
                'title'     => $dish['title'],
                'price'     => $dish['price'],
                'image'     => $dish['image'],
                'chef_id'   => $dish['chef_id'],
                'quantity'  => 1,
            ];
        }

        Session::set('cart', $cart);
        Session::set('success', $dish['title'] . ' added to cart!');
        header("Location: " . url('/browse'));
        exit;
    }

    // Remove from cart
    public function removeFromCart() {
        $dish_id = (int) ($_POST['dish_id'] ?? 0);
        $cart    = Session::get('cart') ?? [];
        unset($cart[$dish_id]);
        Session::set('cart', $cart);
        header("Location: " . url('/cart'));
        exit;
    }

    // Update cart quantity
    public function updateCart() {
        $dish_id  = (int) ($_POST['dish_id'] ?? 0);
        $quantity = (int) ($_POST['quantity'] ?? 1);
        $cart     = Session::get('cart') ?? [];

        if (isset($cart[$dish_id])) {
            if ($quantity <= 0) {
                unset($cart[$dish_id]);
            } else {
                $cart[$dish_id]['quantity'] = $quantity;
            }
        }

        Session::set('cart', $cart);
        header("Location: " . url('/cart'));
        exit;
    }

    // Checkout page
    public function checkout() {
        $user = requireAuth();
        $cart = Session::get('cart') ?? [];

        if (empty($cart)) {
            Session::set('error', 'Your cart is empty.');
            header("Location: " . url('/cart'));
            exit;
        }

        $total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
        $this->view('customer/checkout.php', ['user' => $user, 'cart' => $cart, 'total' => $total]);
    }

    // Place order
    public function placeOrder() {
        $user    = requireAuth();
        $cart    = Session::get('cart') ?? [];
        $address = trim($_POST['address'] ?? '');

        if (empty($cart)) {
            Session::set('error', 'Your cart is empty.');
            header("Location: " . url('/cart'));
            exit;
        }

        if (!$address) {
            Session::set('error', 'Please enter a delivery address.');
            header("Location: " . url('/checkout'));
            exit;
        }

        $pdo = \getDatabase();

        // Group cart by chef
        $byChef = [];
        foreach ($cart as $item) {
            $byChef[$item['chef_id']][] = $item;
        }

        foreach ($byChef as $chef_id => $items) {
            $total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $items));

            // Create order
            $stmt = $pdo->prepare('INSERT INTO orders (customer_id, chef_id, total_price, delivery_address, status) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$user['id'], $chef_id, $total, $address, 'pending']);
            $order_id = $pdo->lastInsertId();

            // Create order items
            foreach ($items as $item) {
                $subtotal = $item['price'] * $item['quantity'];
                $stmt = $pdo->prepare('INSERT INTO order_items (order_id, dish_id, quantity, price, subtotal) VALUES (?, ?, ?, ?, ?)');
                $stmt->execute([$order_id, $item['id'], $item['quantity'], $item['price'], $subtotal]);
            }
        }

        // Clear cart
        Session::set('cart', []);
        Session::set('success', 'Order placed successfully! 🎉');
        header("Location: " . url('/orders/history'));
        exit;
    }

    // Order history
    public function orderHistory() {
        $user = requireAuth();
        $pdo  = \getDatabase();
        $stmt = $pdo->prepare('SELECT orders.*, users.name as chef_name FROM orders JOIN users ON orders.chef_id = users.id WHERE orders.customer_id = ? ORDER BY orders.created_at DESC');
        $stmt->execute([$user['id']]);
        $orders = $stmt->fetchAll();
        $this->view('customer/orders.php', ['user' => $user, 'orders' => $orders]);
    }
}
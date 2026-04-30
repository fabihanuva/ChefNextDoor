<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Dish;
use App\Models\Review;
use App\Models\Favorite;
use App\Models\ChefProfile;

require_once __DIR__ . '/../../config/database.php';

class CustomerController extends Controller {

    // Browse all available dishes
    public function browse() {
        $user = requireAuth();
        if ($user['role'] !== 'customer') {
            header("Location: " . url('/chef-dashboard'));
            exit;
        }

        $keyword  = $_GET['s'] ?? null;
        $category = $_GET['category'] ?? null;

        $dishes = Dish::search($keyword, $category);
        $this->view('customer/browse.php', [
            'user' => $user, 
            'dishes' => $dishes,
            'search' => $keyword,
            'currentCategory' => $category ?: 'All'
        ]);
    }

    // Public chef profile
    public function chef() {
        $user    = requireAuth();
        $chefId  = (int) ($_GET['id'] ?? 0);
        $profile = ChefProfile::findByUserId($chefId);

        if (!$profile) {
            Session::set('error', 'Chef not found.');
            header("Location: " . url('/browse'));
            exit;
        }

        $dishes = Dish::findByChef($chefId);
        $reviews = Review::findByChef($chefId);
        $this->view('customer/chef.php', [
            'user' => $user, 
            'profile' => $profile, 
            'dishes' => $dishes,
            'reviews' => $reviews
        ]);
    }
    
    
    // Browse chefs
    public function chefs() {
        $user = requireAuth();
        if ($user['role'] !== 'customer') {
            header("Location: " . url('/chef-dashboard'));
            exit;
        }
        $pdo  = \getDatabase();
        $stmt = $pdo->prepare('
            SELECT users.id, users.name, chef_profiles.bio, chef_profiles.specialty,
                chef_profiles.location, chef_profiles.rating,
                AVG(reviews.rating) as avg_rating,
                COUNT(reviews.id) as review_count
            FROM users
            LEFT JOIN chef_profiles ON users.id = chef_profiles.user_id
            LEFT JOIN reviews ON users.id = reviews.chef_id
            WHERE users.role = "chef"
            GROUP BY users.id
            ORDER BY avg_rating DESC
        ');
        $stmt->execute();
        $chefs = $stmt->fetchAll();
        $this->view('customer/chefs.php', ['user' => $user, 'chefs' => $chefs]);
    }

    // View chef menu
    public function chefMenu() {
        $user    = requireAuth();
        $chef_id = (int) ($_GET['id'] ?? 0);
        $pdo     = \getDatabase();

        // Get chef info
        $stmt = $pdo->prepare('
            SELECT users.id, users.name, chef_profiles.bio,
                chef_profiles.specialty, chef_profiles.location,
                AVG(reviews.rating) as avg_rating,
                COUNT(reviews.id) as review_count
            FROM users
            LEFT JOIN chef_profiles ON users.id = chef_profiles.user_id
            LEFT JOIN reviews ON users.id = reviews.chef_id
            WHERE users.id = ? AND users.role = "chef"
            GROUP BY users.id
        ');
        $stmt->execute([$chef_id]);
        $chef = $stmt->fetch();

        if (!$chef) {
            Session::set('error', 'Chef not found.');
            header("Location: " . url('/chefs'));
            exit;
        }

        // Get chef dishes
        $stmt = $pdo->prepare('SELECT * FROM dishes WHERE chef_id = ? AND availability = 1 ORDER BY created_at DESC');
        $stmt->execute([$chef_id]);
        $dishes = $stmt->fetchAll();

        // Get cart
        $cart = Session::get('cart') ?? [];

        $this->view('customer/chef-menu.php', [
            'user'   => $user,
            'chef'   => $chef,
            'dishes' => $dishes,
            'cart'   => $cart,
        ]);
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
        $cart         = Session::get('cart') ?? [];
        $subtotal     = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
        $deliveryFee  = empty($cart) ? 0 : 50;
        $total        = $subtotal + $deliveryFee;
        $this->view('customer/cart.php', [
            'user'        => $user,
            'cart'        => $cart,
            'subtotal'    => $subtotal,
            'deliveryFee' => $deliveryFee,
            'total'       => $total
        ]);
    }

    // Add to cart
    public function addToCart() {
        checkCsrf();
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
        Session::set('success', '✓ ' . $dish['title'] . ' added to cart!');
        header("Location: " . url('/chef-menu?id=' . $dish['chef_id']));
        exit;
    }

    // Remove from cart
    public function removeFromCart() {
        checkCsrf();
        $dish_id = (int) ($_POST['dish_id'] ?? 0);
        $cart    = Session::get('cart') ?? [];
        unset($cart[$dish_id]);
        Session::set('cart', $cart);
        header("Location: " . url('/cart'));
        exit;
    }

    // Update cart quantity
    public function updateCart() {
        checkCsrf();
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

        $subtotal    = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
        $deliveryFee = 50;
        $total       = $subtotal + $deliveryFee;

        $this->view('customer/checkout.php', [
            'user'        => $user,
            'cart'        => $cart,
            'subtotal'    => $subtotal,
            'deliveryFee' => $deliveryFee,
            'total'       => $total
        ]);
    }

    // Ajax API — get dishes by chef
    public function getDishesApi() {
        $chef_id  = (int) ($_GET['chef_id'] ?? 0);
        $keyword  = trim($_GET['q'] ?? '');
        $pdo      = \getDatabase();

        $sql    = 'SELECT * FROM dishes WHERE chef_id = ? AND availability = 1';
        $params = [$chef_id];

        if ($keyword) {
            $sql    .= ' AND (title LIKE ? OR description LIKE ? OR category LIKE ?)';
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }

        $sql .= ' ORDER BY created_at DESC';
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $dishes = $stmt->fetchAll();

        header('Content-Type: application/json');
        echo json_encode($dishes);
        exit;
    }

    // Place order
    public function placeOrder() {
        checkCsrf();
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

        $deliveryFee = 50;
        foreach ($byChef as $chef_id => $items) {
            $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $items));
            $total    = $subtotal + $deliveryFee;

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
        Session::set('success', '✓ Order placed successfully! 🎉');
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
    
    // Show review form
    public function reviewForm() {
        $user     = requireAuth();
        $order_id = (int) ($_GET['order_id'] ?? 0);
        $pdo      = \getDatabase();

        $stmt = $pdo->prepare('SELECT * FROM orders WHERE id = ? AND customer_id = ? AND status = "delivered"');
        $stmt->execute([$order_id, $user['id']]);
        $order = $stmt->fetch();

        if (!$order) {
            Session::set('error', 'You can only review delivered orders.');
            header("Location: " . url('/orders/history'));
            exit;
        }

        if (Review::alreadyReviewed($order_id)) {
            Session::set('error', 'You have already reviewed this order.');
            header("Location: " . url('/orders/history'));
            exit;
        }

        $this->view('customer/review.php', ['user' => $user, 'order' => $order]);
    }

    // Submit review
    public function submitReview() {
        checkCsrf();
        $user     = requireAuth();
        $order_id = (int) ($_POST['order_id'] ?? 0);
        $rating   = (int) ($_POST['rating'] ?? 0);
        $comment  = trim($_POST['comment'] ?? '');
        $pdo      = \getDatabase();

        $stmt = $pdo->prepare('SELECT * FROM orders WHERE id = ? AND customer_id = ? AND status = "delivered"');
        $stmt->execute([$order_id, $user['id']]);
        $order = $stmt->fetch();

        if (!$order || $rating < 1 || $rating > 5) {
            Session::set('error', 'Invalid review.');
            header("Location: " . url('/orders/history'));
            exit;
        }

        if (Review::alreadyReviewed($order_id)) {
            Session::set('error', 'You have already reviewed this order.');
            header("Location: " . url('/orders/history'));
            exit;
        }

        Review::create([
            'customer_id' => $user['id'],
            'chef_id'     => $order['chef_id'],
            'order_id'    => $order_id,
            'rating'      => $rating,
            'comment'     => $comment,
        ]);

        Session::set('success', '✓ Review submitted! ⭐');
        header("Location: " . url('/orders/history'));
        exit;
    }

    // Toggle favorite
    public function toggleFavorite() {
        checkCsrf();
        $user    = requireAuth();
        $dish_id = (int) ($_POST['dish_id'] ?? 0);

        if (Favorite::isFavorited($user['id'], $dish_id)) {
            Favorite::remove($user['id'], $dish_id);
            Session::set('success', 'Removed from favourites.');
        } else {
            Favorite::add($user['id'], $dish_id);
            Session::set('success', 'Added to favourites! ❤️');
        }

        $dish = \App\Models\Dish::findById($dish_id);
        header("Location: " . url('/chef-menu?id=' . ($dish['chef_id'] ?? '')));
        exit;
    }

    // View favourites
    public function favorites() {
        $user   = requireAuth();
        $dishes = Favorite::findByCustomer($user['id']);
        $this->view('customer/favorites.php', ['user' => $user, 'dishes' => $dishes]);
    }

    // Track order
    public function trackOrder() {
        $user     = requireAuth();
        $order_id = (int) ($_GET['id'] ?? 0);
        $pdo      = \getDatabase();

        $stmt = $pdo->prepare('
            SELECT orders.*, users.name as chef_name
            FROM orders
            JOIN users ON orders.chef_id = users.id
            WHERE orders.id = ? AND orders.customer_id = ?
        ');
        $stmt->execute([$order_id, $user['id']]);
        $order = $stmt->fetch();

        if (!$order) {
            Session::set('error', 'Order not found.');
            header("Location: " . url('/orders/history'));
            exit;
        }

        // Get order items
        $stmt = $pdo->prepare('
            SELECT order_items.*, dishes.title, dishes.image
            FROM order_items
            JOIN dishes ON order_items.dish_id = dishes.id
            WHERE order_items.order_id = ?
        ');
        $stmt->execute([$order_id]);
        $items = $stmt->fetchAll();

        $this->view('customer/track.php', [
            'user'  => $user,
            'order' => $order,
            'items' => $items,
        ]);
    }
}
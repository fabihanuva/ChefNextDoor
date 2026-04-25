<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Dish;

require_once __DIR__ . '/../../config/database.php';

class DashboardController extends Controller {

    public function index() {
        $user = requireAuth();

        if ($user['role'] !== 'customer') {
            header("Location: " . url('/chef-dashboard'));
            exit;
        }

        $this->view('dashboard.php', ['user' => $user]);
    }

    public function chef() {
        $user = requireAuth();

        if ($user['role'] !== 'chef') {
            header("Location: " . url('/dashboard'));
            exit;
        }

        $pdo = \getDatabase();

        // Total dishes
        $stmt = $pdo->prepare('SELECT COUNT(*) as total FROM dishes WHERE chef_id = ?');
        $stmt->execute([$user['id']]);
        $totalDishes = $stmt->fetch()['total'];

        // Pending orders
        $stmt = $pdo->prepare('SELECT COUNT(*) as total FROM orders WHERE chef_id = ? AND status = "pending"');
        $stmt->execute([$user['id']]);
        $pendingOrders = $stmt->fetch()['total'];

        // Total earnings (delivered orders only)
        $stmt = $pdo->prepare('SELECT SUM(total_price) as total FROM orders WHERE chef_id = ? AND status = "delivered"');
        $stmt->execute([$user['id']]);
        $earnings = $stmt->fetch()['total'] ?? 0;

        // Average rating
        $stmt = $pdo->prepare('SELECT AVG(rating) as avg FROM reviews WHERE chef_id = ?');
        $stmt->execute([$user['id']]);
        $avgRating = round((float)($stmt->fetch()['avg'] ?? 0), 1);

        // Recent reviews
        $stmt = $pdo->prepare('
            SELECT reviews.*, users.name as customer_name
            FROM reviews
            JOIN users ON reviews.customer_id = users.id
            WHERE reviews.chef_id = ?
            ORDER BY reviews.created_at DESC
            LIMIT 5
        ');
        $stmt->execute([$user['id']]);
        $reviews = $stmt->fetchAll();

        $this->view('chef-dashboard.php', [
            'user'          => $user,
            'totalDishes'   => $totalDishes,
            'pendingOrders' => $pendingOrders,
            'earnings'      => $earnings,
            'avgRating'     => $avgRating,
            'reviews'       => $reviews,
        ]);
    }

    public function chefReviews() {
        $user = requireAuth();
        if ($user['role'] !== 'chef') {
            header("Location: " . url('/dashboard'));
            exit;
        }

        $pdo  = \getDatabase();
        $stmt = $pdo->prepare('
            SELECT reviews.*, users.name as customer_name
            FROM reviews
            JOIN users ON reviews.customer_id = users.id
            WHERE reviews.chef_id = ?
            ORDER BY reviews.created_at DESC
        ');
        $stmt->execute([$user['id']]);
        $reviews = $stmt->fetchAll();

        $avgRating = round(array_sum(array_column($reviews, 'rating')) / max(count($reviews), 1), 1);

        $this->view('chef/reviews.php', [
            'user'      => $user,
            'reviews'   => $reviews,
            'avgRating' => $avgRating,
        ]);
   }
    public function testMail() {
        $user = requireAuth();

        $result = \App\Core\Mailer::send(
            $user['email'],
            'Welcome to ChefNextDoor',
            "Hello {$user['name']},\n\nThanks for joining ChefNextDoor!\n\nSent at: " . date('Y-m-d H:i:s')
        );

        if ($result) {
            Session::set('success', 'Test email sent successfully!');
        } else {
            Session::set('error', 'Failed to send test email.');
        }

        header("Location: " . url('/dashboard'));
        exit;
    }
    // Chef order management
    public function orders() {
        $user = requireAuth();
        if ($user['role'] !== 'chef') {
            header("Location: " . url('/dashboard'));
            exit;
        }

        $pdo = \getDatabase();
        $stmt = $pdo->prepare('
            SELECT orders.*, users.name as customer_name
            FROM orders
            JOIN users ON orders.customer_id = users.id
            WHERE orders.chef_id = ?
            ORDER BY orders.created_at DESC
        ');
        $stmt->execute([$user['id']]);
        $orders = $stmt->fetchAll();

        $this->view('chef/orders.php', ['user' => $user, 'orders' => $orders]);
    } 

    // Update order status
    public function updateOrderStatus() {
        $user      = requireAuth();
        $order_id  = (int) ($_POST['order_id'] ?? 0);
        $status    = $_POST['status'] ?? '';

        $allowed = ['accepted', 'preparing', 'out_for_delivery', 'delivered', 'cancelled'];

        if (!in_array($status, $allowed)) {
            Session::set('error', 'Invalid status.');
            header("Location: " . url('/chef/orders'));
            exit;
        }

        $pdo  = \getDatabase();

        // Make sure this order belongs to this chef
        $stmt = $pdo->prepare('SELECT * FROM orders WHERE id = ? AND chef_id = ?');
        $stmt->execute([$order_id, $user['id']]);
        $order = $stmt->fetch();

        if (!$order) {
            Session::set('error', 'Order not found.');
            header("Location: " . url('/chef/orders'));
            exit;
        }

        $stmt = $pdo->prepare('UPDATE orders SET status = ? WHERE id = ?');
        $stmt->execute([$status, $order_id]);

        Session::set('success', 'Order status updated!');
        header("Location: " . url('/chef/orders'));
        exit;
    }
}
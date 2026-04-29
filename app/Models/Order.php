<?php
namespace App\Models;

use PDO;

require_once __DIR__ . '/../../config/database.php';

class Order {
    public static function countPendingByChef(int $chefId): int {
        $pdo  = getDatabase();
        $stmt = $pdo->prepare('SELECT COUNT(*) as total FROM orders WHERE chef_id = ? AND status = "pending"');
        $stmt->execute([$chefId]);
        return (int) ($stmt->fetch()['total'] ?? 0);
    }

    public static function earningsByChef(int $chefId): float {
        $pdo  = getDatabase();
        $stmt = $pdo->prepare('SELECT SUM(total_price) as total FROM orders WHERE chef_id = ? AND status = "delivered"');
        $stmt->execute([$chefId]);
        return (float) ($stmt->fetch()['total'] ?? 0);
    }

    public static function findByChef(int $chefId): array {
        $pdo  = getDatabase();
        $stmt = $pdo->prepare('
            SELECT orders.*, users.name as customer_name
            FROM orders
            JOIN users ON orders.customer_id = users.id
            WHERE orders.chef_id = ?
            ORDER BY orders.created_at DESC
        ');
        $stmt->execute([$chefId]);
        return $stmt->fetchAll();
    }
}

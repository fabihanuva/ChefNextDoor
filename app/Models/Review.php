<?php
namespace App\Models;

use PDO;

require_once __DIR__ . '/../../config/database.php';

class Review {

    public static function create(array $data): void {
        $pdo  = getDatabase();
        $stmt = $pdo->prepare('
            INSERT INTO reviews (customer_id, chef_id, order_id, rating, comment)
            VALUES (?, ?, ?, ?, ?)
        ');
        $stmt->execute([
            $data['customer_id'],
            $data['chef_id'],
            $data['order_id'],
            $data['rating'],
            $data['comment'],
        ]);
    }

    public static function findByChef(int $chefId): array {
        $pdo  = getDatabase();
        $stmt = $pdo->prepare('
            SELECT reviews.*, users.name as customer_name
            FROM reviews
            JOIN users ON reviews.customer_id = users.id
            WHERE reviews.chef_id = ?
            ORDER BY reviews.created_at DESC
        ');
        $stmt->execute([$chefId]);
        return $stmt->fetchAll();
    }

    public static function averageRating(int $chefId): float {
        $pdo  = getDatabase();
        $stmt = $pdo->prepare('SELECT AVG(rating) as avg FROM reviews WHERE chef_id = ?');
        $stmt->execute([$chefId]);
        $row  = $stmt->fetch();
        return round((float) ($row['avg'] ?? 0), 1);
    }

    public static function alreadyReviewed(int $orderId): bool {
        $pdo  = getDatabase();
        $stmt = $pdo->prepare('SELECT id FROM reviews WHERE order_id = ? LIMIT 1');
        $stmt->execute([$orderId]);
        return (bool) $stmt->fetch();
    }
}
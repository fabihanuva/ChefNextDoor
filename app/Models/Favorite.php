<?php
namespace App\Models;

use PDO;

require_once __DIR__ . '/../../config/database.php';

class Favorite {

    public static function add(int $customerId, int $dishId): void {
        $pdo  = getDatabase();
        $stmt = $pdo->prepare('INSERT IGNORE INTO favorites (customer_id, dish_id) VALUES (?, ?)');
        $stmt->execute([$customerId, $dishId]);
    }

    public static function remove(int $customerId, int $dishId): void {
        $pdo  = getDatabase();
        $stmt = $pdo->prepare('DELETE FROM favorites WHERE customer_id = ? AND dish_id = ?');
        $stmt->execute([$customerId, $dishId]);
    }

    public static function isFavorited(int $customerId, int $dishId): bool {
        $pdo  = getDatabase();
        $stmt = $pdo->prepare('SELECT id FROM favorites WHERE customer_id = ? AND dish_id = ? LIMIT 1');
        $stmt->execute([$customerId, $dishId]);
        return (bool) $stmt->fetch();
    }

    public static function findByCustomer(int $customerId): array {
        $pdo  = getDatabase();
        $stmt = $pdo->prepare('
            SELECT dishes.*, users.name as chef_name
            FROM favorites
            JOIN dishes ON favorites.dish_id = dishes.id
            JOIN users ON dishes.chef_id = users.id
            WHERE favorites.customer_id = ?
            ORDER BY favorites.created_at DESC
        ');
        $stmt->execute([$customerId]);
        return $stmt->fetchAll();
    }
}
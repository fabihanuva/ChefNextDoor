<?php
namespace App\Models;

use PDO;

require_once __DIR__ . '/../../config/database.php';

class ChefProfile {
    public static function create(int $userId): void {
        $pdo  = getDatabase();
        $stmt = $pdo->prepare('INSERT INTO chef_profiles (user_id) VALUES (?)');
        $stmt->execute([$userId]);
    }

    public static function findByUserId(int $userId): ?array {
        $pdo  = getDatabase();
        $stmt = $pdo->prepare('SELECT * FROM chef_profiles WHERE user_id = ? LIMIT 1');
        $stmt->execute([$userId]);
        $row  = $stmt->fetch();
        return $row ?: null;
    }
}
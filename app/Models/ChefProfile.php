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
        $stmt = $pdo->prepare('SELECT chef_profiles.*, users.name, users.email FROM chef_profiles JOIN users ON chef_profiles.user_id = users.id WHERE chef_profiles.user_id = ? LIMIT 1');
        $stmt->execute([$userId]);
        $row  = $stmt->fetch();
        return $row ?: null;
    }

    public static function update(int $userId, array $data): void {
        $pdo  = getDatabase();
        $stmt = $pdo->prepare('UPDATE chef_profiles SET bio = ?, specialty = ?, location = ? WHERE user_id = ?');
        $stmt->execute([$data['bio'], $data['specialty'], $data['location'], $userId]);
    }
}
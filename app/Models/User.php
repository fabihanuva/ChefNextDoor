<?php
namespace App\Models;

use PDO;

require_once __DIR__ . '/../../config/database.php';

class User {
    public static function findByEmail(string $email): ?array {
        $stmt = getDatabase()->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

public static function create(string $name, string $role, string $email, string $password): int {
    $pdo = getDatabase();
    $stmt = $pdo->prepare('INSERT INTO users (name, role, email, password) VALUES (?, ?, ?, ?)');
    $stmt->execute([$name, $role, $email, $password]);
    return (int) $pdo->lastInsertId();
}
}

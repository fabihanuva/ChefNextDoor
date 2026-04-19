<?php
namespace App\Models;

use PDO;

require_once __DIR__ . '/../../config/database.php';

class Post {
    public static function create(int $userId, string $content): int {
        $pdo = getDatabase();
        $stmt = $pdo->prepare('INSERT INTO posts (user_id, content) VALUES (?, ?)');
        $stmt->execute([$userId, $content]);
        return (int) $pdo->lastInsertId();
    }

    public static function getAll(int $limit = 10, int $offset = 0): array {
        $pdo = getDatabase();
        $stmt = $pdo->prepare('
            SELECT p.*, u.name as user_name
            FROM posts p
            JOIN users u ON p.user_id = u.id
            ORDER BY p.created_at DESC
            LIMIT :limit OFFSET :offset
        ');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

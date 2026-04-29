<?php
namespace App\Models;
use PDO;
require_once __DIR__ . '/../../config/database.php';

class Dish {

    public static function create(array $data): int {
        $pdo  = getDatabase();
        $stmt = $pdo->prepare('
            INSERT INTO dishes (chef_id, title, description, price, image, category, availability, stock)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ');
        $stmt->execute([
            $data['chef_id'],
            $data['title'] ?? '',
            $data['description'] ?? '',
            $data['price'] ?? 0,
            $data['image'] ?? '',
            $data['category'] ?? '',
            $data['availability'] ?? 1,
            $data['stock'] ?? 0,
        ]);
        return (int) $pdo->lastInsertId();
    }

    public static function findByChef(int $chefId): array {
        $pdo  = getDatabase();
        $stmt = $pdo->prepare('SELECT * FROM dishes WHERE chef_id = ? ORDER BY created_at DESC');
        $stmt->execute([$chefId]);
        return $stmt->fetchAll();
    }

    public static function findById(int $id): ?array {
        $pdo  = getDatabase();
        $stmt = $pdo->prepare('SELECT * FROM dishes WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $row  = $stmt->fetch();
        return $row ?: null;
    }

    public static function update(int $id, array $data): void {
        $pdo  = getDatabase();
        $stmt = $pdo->prepare('
            UPDATE dishes
            SET title=?, description=?, price=?, image=?, category=?, availability=?, stock=?
            WHERE id=?
        ');
        $stmt->execute([
            $data['title'] ?? '',
            $data['description'] ?? '',
            $data['price'] ?? 0,
            $data['image'] ?? '',
            $data['category'] ?? '',
            $data['availability'] ?? 1,
            $data['stock'] ?? 0,
            $id,
        ]);
    }

    public static function delete(int $id): void {
        $pdo  = getDatabase();
        $stmt = $pdo->prepare('DELETE FROM dishes WHERE id = ?');
        $stmt->execute([$id]);
    }

    public static function all(): array {
        $pdo  = getDatabase();
        $stmt = $pdo->query('
            SELECT dishes.*, users.name as chef_name
            FROM dishes
            JOIN users ON dishes.chef_id = users.id
            ORDER BY dishes.created_at DESC
        ');
        return $stmt->fetchAll();
    }

    public static function search(?string $keyword = null, ?string $category = null): array {
        $pdo    = getDatabase();
        $sql    = 'SELECT dishes.*, users.name as chef_name
                   FROM dishes
                   JOIN users ON dishes.chef_id = users.id
                   WHERE dishes.availability = 1';
        $params = [];

        if ($keyword) {
            $sql     .= ' AND (dishes.title LIKE ? OR dishes.description LIKE ?)';
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }

        if ($category && $category !== 'All') {
            $sql     .= ' AND dishes.category = ?';
            $params[] = $category;
        }

        $sql .= ' ORDER BY dishes.created_at DESC';
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}

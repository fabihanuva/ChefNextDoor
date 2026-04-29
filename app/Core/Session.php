<?php
namespace App\Core;

class Session {
    public static function start(): void {
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    public static function set(string $key, $value): void {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key) {
        return $_SESSION[$key] ?? null;
    }

    public static function remove(string $key): void {
        unset($_SESSION[$key]);
    }

    public static function destroy(): void {
        $_SESSION = [];
        if (session_status() !== PHP_SESSION_NONE) {
            session_destroy();
        }
    }

    public static function csrfToken(): string {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function validateCsrf(?string $token): bool {
        $storedToken = $_SESSION['csrf_token'] ?? null;
        return $token && $storedToken && hash_equals($storedToken, $token);
    }
}

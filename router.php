<?php
/**
 * Router script for PHP's built-in development server.
 *
 * Usage: php -S localhost:8000 router.php
 *
 * This file is ONLY used with `php -S`. Apache/XAMPP uses .htaccess instead.
 * Returning false tells the built-in server to serve the file directly (CSS, JS, images).
 */

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $path;

// If the file exists on disk, let the built-in server serve it directly
if ($path !== '/' && is_file($file)) {
    return false;
}

// Everything else goes through index.php
require __DIR__ . '/index.php';

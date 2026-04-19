<?php

/**
 * Generate URL with optional base path from environment.
 * Set BASE_PATH in .env for subdirectory deployments (e.g., /admin-board).
 *
 * Examples:
 *   url('/login')        => '/login'           (no BASE_PATH)
 *   url('/login')        => '/admin-board/login' (BASE_PATH=/admin-board)
 *   url('/assets/style.css') => '/admin-board/assets/style.css'
 */
function url(string $path = ''): string {
    $basePath = rtrim(getenv('BASE_PATH') ?: '', '/');
    $path = '/' . ltrim($path, '/');
    return $basePath . $path;
}

/**
 * Require the user to be logged in.
 * If not logged in, redirect to the login page and stop execution.
 *
 * Usage: $user = requireAuth();
 *
 * @return array The logged-in user data from the session
 */
function requireAuth(): array {
    $user = \App\Core\Session::get('user');
    if (!$user) {
        header('Location: ' . url('/login'));
        exit;
    }
    return $user;
}

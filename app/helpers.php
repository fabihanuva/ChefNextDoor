<?php

/**
 * Escape HTML output.
 */
function e(string $text): string {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/**
 * Get the current CSRF token.
 */
function csrf_token(): string {
    return \App\Core\Session::csrfToken();
}

/**
 * Generate a hidden CSRF input field.
 */
function csrf_field(): string {
    $token = csrf_token();
    return '<input type="hidden" name="csrf_token" value="' . $token . '">';
}

/**
 * Validate CSRF token from POST request.
 * Redirects back with error if invalid.
 */
function checkCsrf(): void {
    $token = $_POST['csrf_token'] ?? null;
    if (!\App\Core\Session::validateCsrf($token)) {
        \App\Core\Session::set('error', 'Security session expired. Please try again.');
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? url('/')));
        exit;
    }
}

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
    $basePath = $_ENV['BASE_PATH'] ?? '/ChefNextDoor/public';
    $basePath = rtrim($basePath, '/');
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

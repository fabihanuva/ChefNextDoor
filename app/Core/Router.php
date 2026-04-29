<?php
namespace App\Core;

/**
 * Router — maps URLs to controller methods.
 *
 * A router is like a receptionist: when a request arrives, the router looks at
 * the URL and HTTP method (GET or POST) and decides which controller method
 * should handle it.
 *
 * Usage (in index.php):
 *   $router->get('/login', [$authController, 'showLogin']);
 *   $router->post('/login', [$authController, 'login']);
 *   $router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
 */
class Router {
    /** @var array All registered routes, grouped by HTTP method */
    private array $routes = [];

    /**
     * Register a GET route.
     * GET routes are for displaying pages (e.g., show the login form).
     */
    public function get(string $path, callable $callback): void {
        $this->routes['GET'][$path] = $callback;
    }

    /**
     * Register a POST route.
     * POST routes are for processing form submissions (e.g., log the user in).
     */
    public function post(string $path, callable $callback): void {
        $this->routes['POST'][$path] = $callback;
    }

    /**
     * Dispatch the request — find and run the matching route.
     *
     * Steps:
     * 1. Parse the URL to get just the path (strip query string like ?page=2)
     * 2. Strip the BASE_PATH prefix so routes work in subdirectories
     * 3. Look up the matching callback and call it
     * 4. If no match, show a 404 error
     */
    public function dispatch(string $uri, string $method): void {
        // Get just the path part of the URL (removes ?page=2 etc.)
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';

        // Strip BASE_PATH so routes work when the app is in a subdirectory
        // e.g., /admin-board/login becomes /login
        $basePath = rtrim($_ENV['BASE_PATH'] ?? '', '/');
        if ($basePath && strpos($path, $basePath) === 0) {
            $path = substr($path, strlen($basePath)) ?: '/';
        }

        // Find the registered callback for this method + path
        $callback = $this->routes[$method][$path] ?? null;

        if (!$callback) {
            http_response_code(404);
            $title   = '404 | ChefNextDoor';
            $content = '';
            ob_start();
            include __DIR__ . '/../Views/404.php';
            echo ob_get_clean();
            return;
        }

        // Run the matched controller method
        echo call_user_func($callback);
    }

    /**
     * Redirect the browser to a different URL.
     */
    public function redirect(string $path): void {
        header("Location: $path");
        exit;
    }
}

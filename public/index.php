<?php
declare(strict_types=1);

// 🔴 Show errors (keep during development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// --- 1. Load dependencies ---
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/helpers.php';

use App\Core\Router;
use App\Core\Session;
use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\PostController;

// --- 2. Start session ---
Session::start();

// --- 3. Create instances ---
$router = new Router();
$auth   = new AuthController();
$dash   = new DashboardController();
$posts  = new PostController();

// --- 4. Define routes ---

// Pages (GET)
$router->get('/',          [$auth, 'showLogin']);
$router->get('/login',     [$auth, 'showLogin']);
$router->get('/register',  [$auth, 'showRegister']);
$router->get('/dashboard', [$dash, 'index']);
$router->get('/chef-dashboard', [$dash, 'chef']); // ✅ ADDED
$router->get('/test-mail', [$dash, 'testMail']);
$router->get('/posts',     [$posts, 'index']);

// API
$router->get('/api/posts', [$posts, 'getPosts']);

// POST routes
$router->post('/register', [$auth, 'register']);
$router->post('/login',    [$auth, 'login']);
$router->post('/posts',    [$posts, 'create']);

// Auth
$router->get('/logout', [$auth, 'logout']);

// --- 5. Fix URL before dispatch (CRITICAL) ---
$uri = $_SERVER['REQUEST_URI'] ?? '/';

// Remove project base path
$basePath = '/ChefNextDoor/public';
$uri = str_replace($basePath, '', $uri);

// Remove query string
$uri = strtok($uri, '?');

// --- 6. Dispatch ---
$router->dispatch($uri, $_SERVER['REQUEST_METHOD'] ?? 'GET');
<?php
declare(strict_types=1);

// 🔴 Show errors (keep during development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// --- 1. Load dependencies ---
require __DIR__ . '/../vendor/autoload.php';


// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

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

// Placeholder routes for Chef features
$router->get('/dishes/create', function() { echo "Add New Dish feature coming soon!"; });
$router->get('/dishes',        function() { echo "My Dishes feature coming soon!"; });
$router->get('/orders',        function() { echo "Manage Orders feature coming soon!"; });
$router->get('/earnings',      function() { echo "Earnings feature coming soon!"; });

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
$uri = str_replace('/ChefNextDoor/public', '', $uri);
$uri = strtok($uri, '?');
if ($uri === '' || $uri === false) $uri = '/';

// --- 6. Dispatch ---
$router->dispatch($uri, $_SERVER['REQUEST_METHOD'] ?? 'GET');
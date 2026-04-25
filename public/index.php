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
use App\Controllers\DishController;
use App\Controllers\CustomerController;
// --- 2. Start session ---
Session::start();

// --- 3. Create instances ---
$router = new Router();
$auth   = new AuthController();
$dash   = new DashboardController();
$posts  = new PostController();
$dish   = new DishController();
$customer = new CustomerController();
// --- 4. Define routes ---

// Auth pages (GET)
$router->get('/',          [$auth, 'showLogin']);
$router->get('/login',     [$auth, 'showLogin']);
$router->get('/register',  [$auth, 'showRegister']);

// Dashboards (GET)
$router->get('/dashboard',      [$dash, 'index']);
$router->get('/chef-dashboard', [$dash, 'chef']);
$router->get('/test-mail',      [$dash, 'testMail']);

// Posts (GET)
$router->get('/posts',     [$posts, 'index']);
$router->get('/api/posts', [$posts, 'getPosts']);

// Dish routes (GET)
$router->get('/dishes',        [$dish, 'index']);
$router->get('/dishes/create', [$dish, 'create']);
$router->get('/dishes/edit',   [$dish, 'edit']);

// Dish routes (POST)
$router->post('/dishes/store',  [$dish, 'store']);
$router->post('/dishes/update', [$dish, 'update']);
$router->post('/dishes/delete', [$dish, 'destroy']);
// Customer routes
$router->get('/browse',         [$customer, 'browse']);
$router->get('/dish',           [$customer, 'dish']);
$router->get('/cart',           [$customer, 'cart']);
$router->get('/checkout',       [$customer, 'checkout']);
$router->get('/orders/history', [$customer, 'orderHistory']);

$router->post('/cart/add',      [$customer, 'addToCart']);
$router->post('/cart/remove',   [$customer, 'removeFromCart']);
$router->post('/cart/update',   [$customer, 'updateCart']);
$router->post('/order/place',   [$customer, 'placeOrder']);

// Chef order management
$router->get('/chef/orders',          [$dash, 'orders']);
$router->post('/chef/orders/update',  [$dash, 'updateOrderStatus']);

// Placeholder routes
$router->get('/orders',   function() { echo "Manage Orders coming soon!"; });
$router->get('/earnings', function() { echo "Earnings coming soon!"; });

// Auth routes
$router->post('/register', [$auth, 'register']);
$router->post('/login',    [$auth, 'login']);
$router->post('/posts',    [$posts, 'create']);
$router->get('/logout',    [$auth, 'logout']);

// --- 5. Fix URL before dispatch (CRITICAL) ---
$uri = $_SERVER['REQUEST_URI'] ?? '/';
$uri = str_replace('/ChefNextDoor/public', '', $uri);
$uri = strtok($uri, '?');
if ($uri === '' || $uri === false) $uri = '/';

// --- 6. Dispatch ---
$router->dispatch($uri, $_SERVER['REQUEST_METHOD'] ?? 'GET');
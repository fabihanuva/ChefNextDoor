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
use App\Controllers\ProfileController;
use App\Controllers\SupportController;
// --- 2. Start session ---
Session::start();

// --- 3. Create instances ---
$router = new Router();
$auth   = new AuthController();
$dash   = new DashboardController();
$posts  = new PostController();
$dish   = new DishController();
$customer = new CustomerController();
$profile = new ProfileController();
$support = new SupportController();

// --- 4. Define routes ---

// Auth (GET)
$router->get('/',         [$auth, 'showLogin']);
$router->get('/login',    [$auth, 'showLogin']);
$router->get('/register', [$auth, 'showRegister']);
$router->get('/logout',   [$auth, 'logout']);

// Auth (POST)
$router->post('/register', [$auth, 'register']);
$router->post('/login',    [$auth, 'login']);

// Support pages
$router->get('/about',   [$support, 'about']);
$router->get('/help',    [$support, 'help']);
$router->get('/terms',   [$support, 'terms']);
$router->get('/privacy', [$support, 'privacy']);

// Dashboards
$router->get('/dashboard',      [$dash, 'index']);
$router->get('/chef-dashboard', [$dash, 'chef']);
$router->get('/test-mail',      [$dash, 'testMail']);

// Posts
$router->get('/posts',     [$posts, 'index']);
$router->get('/api/posts', [$posts, 'getPosts']);
$router->post('/posts',    [$posts, 'create']);

// Dishes (GET)
$router->get('/dishes',        [$dish, 'index']);
$router->get('/dishes/create', [$dish, 'create']);
$router->get('/dishes/edit',   [$dish, 'edit']);

// Dishes (POST)
$router->post('/dishes/store',  [$dish, 'store']);
$router->post('/dishes/update', [$dish, 'update']);
$router->post('/dishes/delete', [$dish, 'destroy']);

// Customer (GET)
$router->get('/browse',              [$customer, 'browse']);
$router->get('/chefs',               [$customer, 'chefs']);
$router->get('/chef-menu',           [$customer, 'chefMenu']);
$router->get('/chef/profile/public', [$customer, 'chef']);
$router->get('/dish',                [$customer, 'dish']);
$router->get('/cart',                [$customer, 'cart']);
$router->get('/checkout',            [$customer, 'checkout']);
$router->get('/orders/history',      [$customer, 'orderHistory']);
$router->get('/order/track',         [$customer, 'trackOrder']);
$router->get('/review',              [$customer, 'reviewForm']);
$router->get('/favorites',           [$customer, 'favorites']);

// Customer (POST)
$router->post('/cart/add',        [$customer, 'addToCart']);
$router->post('/cart/remove',     [$customer, 'removeFromCart']);
$router->post('/cart/update',     [$customer, 'updateCart']);
$router->post('/order/place',     [$customer, 'placeOrder']);
$router->post('/review/submit',   [$customer, 'submitReview']);
$router->post('/favorite/toggle', [$customer, 'toggleFavorite']);

// Chef order management
$router->get('/chef/orders',         [$dash, 'orders']);
$router->get('/chef/reviews',        [$dash, 'chefReviews']);
$router->post('/chef/orders/update', [$dash, 'updateOrderStatus']);

// Profile
$router->get('/profile',              [$profile, 'show']);
$router->get('/chef/profile',         [$profile, 'chefProfile']);
$router->post('/profile/update',      [$profile, 'update']);
$router->post('/profile/password',    [$profile, 'changePassword']);
$router->post('/chef/profile/update', [$profile, 'updateChefProfile']);



// --- 5. Fix URL before dispatch (CRITICAL) ---
$basePath = rtrim($_ENV['BASE_PATH'] ?? '/ChefNextDoor/public', '/');
$uri = $_SERVER['REQUEST_URI'] ?? '/';

// Strip BASE_PATH only from the beginning
if ($basePath !== '' && strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}

$uri = strtok($uri, '?');
if ($uri === '' || $uri === false) $uri = '/';

// --- 6. Dispatch ---
$router->dispatch($uri, $_SERVER['REQUEST_METHOD'] ?? 'GET');
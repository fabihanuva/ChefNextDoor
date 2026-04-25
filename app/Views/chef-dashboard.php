<?php
use App\Core\Session;
$title = 'Chef Dashboard | ChefNextDoor';
ob_start();
?>
<div class="min-h-screen bg-brand-50">
    <nav class="bg-white border-b border-orange-100 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-2xl">🍳</span>
            <span class="text-lg font-bold text-brand-600">ChefNextDoor</span>
        </div>
        <div class="flex items-center gap-4">
            <span class="text-sm text-gray-500">Hi, <strong class="text-gray-700"><?= htmlspecialchars($user['name']) ?></strong></span>
            <a href="<?= url('/logout') ?>" class="text-sm bg-brand-500 hover:bg-brand-600 text-white px-4 py-2 rounded-xl font-medium transition-colors">Logout</a>
        </div>
    </nav>
    <div class="max-w-4xl mx-auto px-6 py-10">

        <!-- Flash messages -->
        <?php if (Session::get('success')): ?>
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                <?= htmlspecialchars(Session::get('success')) ?>
                <?php Session::remove('success'); ?>
            </div>
        <?php endif; ?>

        <?php if (Session::get('error')): ?>
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                <?= htmlspecialchars(Session::get('error')) ?>
                <?php Session::remove('error'); ?>
            </div>
        <?php endif; ?>

        <!-- Welcome banner -->
        <div class="bg-white rounded-2xl border border-orange-100 p-6 mb-6 flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-brand-100 flex items-center justify-center text-2xl font-bold text-brand-600">
                <?= strtoupper(substr($user['name'], 0, 1)) ?>
            </div>
            <div>
                <h1 class="text-xl font-bold text-gray-800">Chef Dashboard 👨‍🍳</h1>
                <p class="text-sm text-gray-500 mt-0.5">Welcome back, <?= htmlspecialchars($user['name']) ?>!</p>
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-2xl border border-orange-100 p-5 text-center">
                <p class="text-3xl font-bold text-brand-500">0</p>
                <p class="text-sm text-gray-500 mt-1">My Dishes</p>
            </div>
            <div class="bg-white rounded-2xl border border-orange-100 p-5 text-center">
                <p class="text-3xl font-bold text-brand-500">0</p>
                <p class="text-sm text-gray-500 mt-1">Pending Orders</p>
            </div>
            <div class="bg-white rounded-2xl border border-orange-100 p-5 text-center">
                <p class="text-3xl font-bold text-brand-500">$0</p>
                <p class="text-sm text-gray-500 mt-1">Earnings</p>
            </div>
        </div>

        <!-- Actions -->
        <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Manage</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <a href="<?= url('/dishes/create') ?>" class="bg-white rounded-2xl border border-orange-100 p-5 hover:border-brand-400 transition-colors group">
                <div class="text-3xl mb-3">➕</div>
                <h3 class="font-semibold text-gray-800 group-hover:text-brand-600">Add New Dish</h3>
                <p class="text-xs text-gray-400 mt-1">List a new home-cooked dish</p>
            </a>
            <a href="<?= url('/dishes') ?>" class="bg-white rounded-2xl border border-orange-100 p-5 hover:border-brand-400 transition-colors group">
                <div class="text-3xl mb-3">🍽️</div>
                <h3 class="font-semibold text-gray-800 group-hover:text-brand-600">My Dishes</h3>
                <p class="text-xs text-gray-400 mt-1">View and manage your listed dishes</p>
            </a>
            <a href="<?= url('/chef/orders') ?>" class="bg-white rounded-2xl border border-orange-100 p-5 hover:border-brand-400 transition-colors group">
                <div class="text-3xl mb-3">📦</div>
                <h3 class="font-semibold text-gray-800 group-hover:text-brand-600">Manage Orders</h3>
                <p class="text-xs text-gray-400 mt-1">Accept, prepare and deliver orders</p>
            </a>
            <a href="<?= url('/chef-dashboard') ?>" class="bg-white rounded-2xl border border-orange-100 p-5 hover:border-brand-400 transition-colors group">
                <div class="text-3xl mb-3">📊</div>
                <h3 class="font-semibold text-gray-800 group-hover:text-brand-600">Earnings</h3>
                <p class="text-xs text-gray-400 mt-1">View your revenue and ratings</p>
            </a>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
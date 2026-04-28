<?php
use App\Core\Session;
$title = 'Dashboard | ChefNextDoor';
ob_start();
?>

<!-- Navbar -->
<nav class="bg-white border-b border-brand-100 px-6 py-4 flex items-center justify-between">
    <div class="flex items-center gap-2">
        <span class="text-2xl">🍳</span>
        <span class="text-lg font-bold text-brand-600">ChefNextDoor</span>
    </div>
    <div class="flex items-center gap-3">
        <?php $cartCount = array_sum(array_column(Session::get('cart') ?? [], 'quantity')); ?>
        <a href="<?= url('/cart') ?>" class="text-sm text-gray-500 hover:text-brand-600">
            🛒 Cart
            <?php if ($cartCount > 0): ?>
                <span class="ml-1 bg-brand-500 text-white text-xs px-1.5 py-0.5 rounded-full"><?= $cartCount ?></span>
            <?php endif; ?>
        </a>
        <a href="<?= url('/profile') ?>" class="text-sm text-gray-500 hover:text-brand-600">👤 Profile</a>
        <a href="<?= url('/logout') ?>"
           class="text-sm bg-brand-500 hover:bg-brand-600 text-white px-4 py-2 rounded-xl font-medium transition-colors">
            Logout
        </a>
    </div>
</nav>

<div class="max-w-6xl mx-auto px-6 py-12">

    <!-- Flash messages -->
    <?php if (Session::get('success')): ?>
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
            <?= htmlspecialchars(Session::get('success')) ?>
            <?php Session::remove('success'); ?>
        </div>
    <?php endif; ?>
    <?php if (Session::get('error')): ?>
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
            <?= htmlspecialchars(Session::get('error')) ?>
            <?php Session::remove('error'); ?>
        </div>
    <?php endif; ?>

    <!-- Welcome Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
        <div class="flex items-center gap-5">
            <div class="relative">
                <div class="w-20 h-20 rounded-2xl bg-brand-500 flex items-center justify-center text-3xl font-bold text-white shadow-lg">
                    <?= strtoupper(substr($user['name'], 0, 1)) ?>
                </div>
                <div class="absolute -bottom-1 -right-1 bg-green-500 border-4 border-white w-6 h-6 rounded-full"></div>
            </div>
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    Welcome back, <span class="text-brand-600"><?= htmlspecialchars($user['name']) ?></span>! 👋
                </h1>
                <p class="text-gray-500 mt-1 flex items-center gap-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-brand-50 text-brand-700 capitalize">
                        <?= htmlspecialchars($user['role']) ?>
                    </span>
                    <span class="text-gray-300">•</span>
                    <?= htmlspecialchars($user['email']) ?>
                </p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="<?= url('/chefs') ?>" class="btn-primary flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Explore Dishes
            </a>
        </div>
    </div>

    <!-- Stats — now clickable -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <a href="<?= url('/cart') ?>" class="card-base p-6 hover:-translate-y-1 transition-all duration-300">
            <div class="flex flex-col md:flex-row items-center gap-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Active Cart</p>
                    <p class="text-2xl font-bold text-gray-900"><?= $cartCount ?> Items</p>
                </div>
            </div>
        </a>

        <a href="<?= url('/favorites') ?>" class="card-base p-6 hover:-translate-y-1 transition-all duration-300">
            <div class="flex flex-col md:flex-row items-center gap-4">
                <div class="p-3 bg-red-50 text-red-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Favourites</p>
                    <p class="text-2xl font-bold text-gray-900">Saved Meals</p>
                </div>
            </div>
        </a>

        <a href="<?= url('/orders/history') ?>" class="card-base p-6 hover:-translate-y-1 transition-all duration-300">
            <div class="flex flex-col md:flex-row items-center gap-4">
                <div class="p-3 bg-green-50 text-green-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">My Orders</p>
                    <p class="text-2xl font-bold text-gray-900">Track History</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Quick Actions -->
    <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6">Quick Actions</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <a href="<?= url('/chefs') ?>" class="card-base p-8 hover:-translate-y-1 transition-all duration-300 group text-center md:text-left">
            <div class="w-14 h-14 rounded-2xl bg-brand-50 flex items-center justify-center text-3xl mb-6 mx-auto md:mx-0 group-hover:scale-110 transition-transform">
                🍽️
            </div>
            <h3 class="font-bold text-gray-800 text-lg group-hover:text-brand-600 transition-colors">Browse Dishes</h3>
            <p class="text-sm text-gray-500 mt-2 leading-relaxed">Explore delicious home-cooked meals prepared with love.</p>
        </a>

        <a href="<?= url('/orders/history') ?>" class="card-base p-8 hover:-translate-y-1 transition-all duration-300 group text-center md:text-left">
            <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-3xl mb-6 mx-auto md:mx-0 group-hover:scale-110 transition-transform">
                📦
            </div>
            <h3 class="font-bold text-gray-800 text-lg group-hover:text-brand-600 transition-colors">My Orders</h3>
            <p class="text-sm text-gray-500 mt-2 leading-relaxed">Keep track of your current and past food adventures.</p>
        </a>

        <a href="<?= url('/cart') ?>" class="card-base p-8 hover:-translate-y-1 transition-all duration-300 group text-center md:text-left">
            <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center text-3xl mb-6 mx-auto md:mx-0 group-hover:scale-110 transition-transform">
                🛒
            </div>
            <h3 class="font-bold text-gray-800 text-lg group-hover:text-brand-600 transition-colors">My Cart</h3>
            <p class="text-sm text-gray-500 mt-2 leading-relaxed">Ready to checkout? Review your selected dishes here.</p>
        </a>

        <a href="<?= url('/favorites') ?>" class="card-base p-8 hover:-translate-y-1 transition-all duration-300 group text-center md:text-left">
            <div class="w-14 h-14 rounded-2xl bg-red-50 flex items-center justify-center text-3xl mb-6 mx-auto md:mx-0 group-hover:scale-110 transition-transform">
                ❤️
            </div>
            <h3 class="font-bold text-gray-800 text-lg group-hover:text-brand-600 transition-colors">Favourites</h3>
            <p class="text-sm text-gray-500 mt-2 leading-relaxed">Quick access to the chefs and dishes you love most.</p>
        </a>

    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
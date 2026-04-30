<?php
use App\Core\Session;
$title = 'Dashboard | ChefNextDoor';
ob_start();

// Make sure $user and $cartCount are available
$user = \App\Core\Session::get('user') ?? [];
$cartCount = array_sum(array_column(Session::get('cart') ?? [], 'quantity'));
?>
<!-- Navbar -->
<?php include __DIR__ . '/partials/navbar.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-8 sm:py-12">

    <!-- Flash messages -->
    <?php if (Session::get('success')): ?>
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm animate-in fade-in slide-in-from-top-2">
            <?= htmlspecialchars(Session::get('success')) ?>
            <?php Session::remove('success'); ?>
        </div>
    <?php endif; ?>
    <?php if (Session::get('error')): ?>
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm animate-in fade-in slide-in-from-top-2">
            <?= htmlspecialchars(Session::get('error')) ?>
            <?php Session::remove('error'); ?>
        </div>
    <?php endif; ?>

    <!-- Welcome Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10 sm:mb-12">
        <div class="flex items-center gap-4 sm:gap-5">
            <div class="relative shrink-0">
                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-brand-500 flex items-center justify-center text-2xl sm:text-3xl font-bold text-white shadow-lg">
                    <?= strtoupper(substr($user['name'], 0, 1)) ?>
                </div>
                <div class="absolute -bottom-1 -right-1 bg-green-500 border-4 border-white w-5 h-5 sm:w-6 sm:h-6 rounded-full"></div>
            </div>
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight leading-tight">
                    Welcome back, <br class="sm:hidden"/><span class="text-brand-600"><?= htmlspecialchars($user['name']) ?></span>! 👋
                </h1>
                <p class="text-gray-500 mt-1 flex flex-wrap items-center gap-2 text-sm">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-brand-50 text-brand-700 uppercase tracking-wider">
                        <?= htmlspecialchars($user['role']) ?>
                    </span>
                    <span class="hidden sm:inline text-gray-300">•</span>
                    <span class="truncate max-w-[200px] sm:max-w-none"><?= htmlspecialchars($user['email']) ?></span>
                </p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="<?= url('/chefs') ?>" class="w-full sm:w-auto btn-primary flex items-center justify-center gap-2 py-3 sm:py-2.5 shadow-xl shadow-brand-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Explore Chefs
            </a>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mb-10 sm:mb-12">
        <a href="<?= url('/cart') ?>" class="card-base p-5 sm:p-6 hover:border-brand-300 hover:shadow-md transition-all group">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Active Cart</p>
                    <p class="text-xl sm:text-2xl font-bold text-gray-900"><?= $cartCount ?> Items</p>
                </div>
            </div>
        </a>

        <a href="<?= url('/favorites') ?>" class="card-base p-5 sm:p-6 hover:border-red-300 hover:shadow-md transition-all group">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-red-50 text-red-600 rounded-xl group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Favourites</p>
                    <p class="text-xl sm:text-2xl font-bold text-gray-900">Saved Meals</p>
                </div>
            </div>
        </a>

        <a href="<?= url('/orders/history') ?>" class="card-base p-5 sm:p-6 hover:border-green-300 hover:shadow-md transition-all group">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-green-50 text-green-600 rounded-xl group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">My Orders</p>
                    <p class="text-xl sm:text-2xl font-bold text-gray-900">Track History</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Quick Actions -->
    <h2 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-6">Explore ChefNextDoor</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">

        <a href="<?= url('/chefs') ?>" class="card-base p-6 sm:p-8 hover:-translate-y-1 transition-all duration-300 group">
            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-brand-50 flex items-center justify-center text-2xl sm:text-3xl mb-6 group-hover:scale-110 transition-transform">
                👨‍🍳
            </div>
            <h3 class="font-bold text-gray-800 text-lg group-hover:text-brand-600 transition-colors">Browse Chefs</h3>
            <p class="text-sm text-gray-500 mt-2 leading-relaxed">Discover talented home cooks in your area.</p>
        </a>

        <a href="<?= url('/orders/history') ?>" class="card-base p-6 sm:p-8 hover:-translate-y-1 transition-all duration-300 group">
            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-2xl sm:text-3xl mb-6 group-hover:scale-110 transition-transform">
                📦
            </div>
            <h3 class="font-bold text-gray-800 text-lg group-hover:text-brand-600 transition-colors">My Orders</h3>
            <p class="text-sm text-gray-500 mt-2 leading-relaxed">Keep track of your current and past food adventures.</p>
        </a>

        <a href="<?= url('/cart') ?>" class="card-base p-6 sm:p-8 hover:-translate-y-1 transition-all duration-300 group">
            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-green-50 flex items-center justify-center text-2xl sm:text-3xl mb-6 group-hover:scale-110 transition-transform">
                🛒
            </div>
            <h3 class="font-bold text-gray-800 text-lg group-hover:text-brand-600 transition-colors">My Cart</h3>
            <p class="text-sm text-gray-500 mt-2 leading-relaxed">Ready to checkout? Review your selected dishes here.</p>
        </a>

        <a href="<?= url('/favorites') ?>" class="card-base p-6 sm:p-8 hover:-translate-y-1 transition-all duration-300 group">
            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-red-50 flex items-center justify-center text-2xl sm:text-3xl mb-6 group-hover:scale-110 transition-transform">
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
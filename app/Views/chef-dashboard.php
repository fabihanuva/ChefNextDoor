<?php
use App\Core\Session;
$title = 'Chef Dashboard | ChefNextDoor';
ob_start();
?>

<!-- Navbar -->
<?php include __DIR__ . '/partials/navbar.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-8 sm:py-12">

    <!-- Flash messages -->
    <?php if (Session::get('success')): ?>
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm animate-in fade-in slide-in-from-top-2">
            <?= e(Session::get('success')) ?>
            <?php Session::remove('success'); ?>
        </div>
    <?php endif; ?>
    <?php if (Session::get('error')): ?>
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm animate-in fade-in slide-in-from-top-2">
            <?= e(Session::get('error')) ?>
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
                <div class="absolute -bottom-1 -right-1 bg-brand-500 border-4 border-white w-5 h-5 sm:w-6 sm:h-6 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M20 6 9 17 4 12"/></svg>
                </div>
            </div>
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight leading-tight">
                    Chef <span class="text-brand-600"><?= e($user['name']) ?></span>
                </h1>
                <p class="text-gray-500 mt-1 flex flex-wrap items-center gap-2 text-sm">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-brand-100 text-brand-700 uppercase tracking-wider">
                        Home Chef
                    </span>
                    <span class="hidden sm:inline text-gray-300">•</span>
                    Manage your kitchen and orders
                </p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="<?= url('/dishes/create') ?>"
               class="w-full sm:w-auto btn-primary flex items-center justify-center gap-2 py-3 sm:py-2.5 shadow-xl shadow-brand-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Add New Dish
            </a>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-10 sm:mb-12">
        <div class="card-base p-5 sm:p-6 text-center">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">My Dishes</p>
            <p class="text-3xl sm:text-4xl font-black text-brand-600"><?= $totalDishes ?></p>
        </div>
        <div class="card-base p-5 sm:p-6 text-center">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Pending</p>
            <p class="text-3xl sm:text-4xl font-black text-yellow-500"><?= $pendingOrders ?></p>
        </div>
        <div class="card-base p-5 sm:p-6 text-center">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Earnings</p>
            <p class="text-2xl sm:text-3xl lg:text-4xl font-black text-green-600 truncate">৳<?= number_format($earnings, 0) ?></p>
        </div>
        <div class="card-base p-5 sm:p-6 text-center">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Rating</p>
            <div class="flex items-center justify-center gap-1">
                <p class="text-3xl sm:text-4xl font-black text-brand-500"><?= $avgRating > 0 ? $avgRating : 'N/A' ?></p>
                <?php if ($avgRating > 0): ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="text-yellow-400"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Main Actions -->
        <div class="lg:col-span-2">
            <h2 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-6">Management</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <a href="<?= url('/dishes') ?>" class="card-base p-6 sm:p-8 hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-brand-50 flex items-center justify-center text-2xl sm:text-3xl mb-6 group-hover:scale-110 transition-transform">
                        🍽️
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg group-hover:text-brand-600 transition-colors">Dish Menu</h3>
                    <p class="text-sm text-gray-500 mt-2 leading-relaxed">Update prices, availability, and descriptions of your meals.</p>
                </a>
                <a href="<?= url('/chef/orders') ?>" class="card-base p-6 sm:p-8 hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-2xl sm:text-3xl mb-6 group-hover:scale-110 transition-transform">
                        📦
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg group-hover:text-brand-600 transition-colors">Order Queue</h3>
                    <p class="text-sm text-gray-500 mt-2 leading-relaxed">View incoming orders and manage their fulfillment status.</p>
                </a>
                <a href="<?= url('/chef/reviews') ?>" class="card-base p-6 sm:p-8 hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-yellow-50 flex items-center justify-center text-2xl sm:text-3xl mb-6 group-hover:scale-110 transition-transform">
                        ⭐
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg group-hover:text-brand-600 transition-colors">My Reviews</h3>
                    <p class="text-sm text-gray-500 mt-2 leading-relaxed">See what customers say about your cooking.</p>
                </a>
                <a href="<?= url('/chef/profile') ?>" class="card-base p-6 sm:p-8 hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-green-50 flex items-center justify-center text-2xl sm:text-3xl mb-6 group-hover:scale-110 transition-transform">
                        👨‍🍳
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg group-hover:text-brand-600 transition-colors">My Profile</h3>
                    <p class="text-sm text-gray-500 mt-2 leading-relaxed">Update your bio, specialty and location.</p>
                </a>
            </div>
        </div>

        <!-- Recent Reviews Sidebar -->
        <div class="lg:col-span-1">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Latest Reviews</h2>
                <a href="<?= url('/chef/reviews') ?>" class="text-[10px] font-bold text-brand-600 hover:underline uppercase tracking-wider">View All</a>
            </div>

            <?php if (empty($reviews)): ?>
                <div class="card-base p-8 text-center bg-white/50">
                    <div class="text-4xl mb-3">⭐</div>
                    <p class="text-sm text-gray-400 italic font-medium">No reviews yet. Keep cooking great food!</p>
                </div>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach (array_slice($reviews, 0, 3) as $review): ?>
                        <div class="card-base p-5 hover:border-brand-200 transition-colors group">
                            <div class="flex items-center justify-between mb-3">
                                <p class="font-bold text-gray-800 text-sm group-hover:text-brand-600 transition-colors"><?= e($review['customer_name']) ?></p>
                                <div class="flex text-yellow-400">
                                    <?php for ($i = 0; $i < $review['rating']; $i++): ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 leading-relaxed mb-3">"<?= e($review['comment'] ?? 'No comment provided.') ?>"</p>
                            <p class="text-[10px] text-gray-300 font-bold uppercase tracking-wider"><?= date('d M Y', strtotime($review['created_at'])) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';

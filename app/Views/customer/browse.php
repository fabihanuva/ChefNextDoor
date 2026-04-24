<?php
use App\Core\Session;
$title = 'Browse Dishes | ChefNextDoor';
ob_start();
?>
<div class="min-h-screen bg-brand-50">
    <nav class="bg-white border-b border-orange-100 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-2xl">🍳</span>
            <span class="text-lg font-bold text-brand-600">ChefNextDoor</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="<?= url('/cart') ?>" class="relative text-sm text-gray-500 hover:text-brand-600">
                🛒 Cart
                <?php $cartCount = array_sum(array_column(Session::get('cart') ?? [], 'quantity')); ?>
                <?php if ($cartCount > 0): ?>
                    <span class="ml-1 bg-brand-500 text-white text-xs px-1.5 py-0.5 rounded-full"><?= $cartCount ?></span>
                <?php endif; ?>
            </a>
            <a href="<?= url('/dashboard') ?>" class="text-sm text-gray-500 hover:text-brand-600">← Dashboard</a>
            <a href="<?= url('/logout') ?>" class="text-sm bg-brand-500 hover:bg-brand-600 text-white px-4 py-2 rounded-xl font-medium transition-colors">Logout</a>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto px-6 py-10">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">🍽️ Browse Dishes</h1>
        <p class="text-sm text-gray-400 mb-6">Fresh home-cooked meals from chefs near you</p>

        <?php if (Session::get('success')): ?>
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                <?= htmlspecialchars(Session::get('success')) ?>
                <?php Session::remove('success'); ?>
            </div>
        <?php endif; ?>

        <?php if (empty($dishes)): ?>
            <div class="bg-white rounded-2xl border border-orange-100 p-12 text-center">
                <div class="text-5xl mb-4">🍽️</div>
                <h2 class="text-lg font-semibold text-gray-700">No dishes available yet</h2>
                <p class="text-sm text-gray-400 mt-1">Check back soon!</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <?php foreach ($dishes as $d): ?>
                    <?php if (!$d['availability']) continue; ?>
                    <div class="bg-white rounded-2xl border border-orange-100 overflow-hidden hover:border-brand-300 transition-colors">
                        <?php if ($d['image']): ?>
                            <img src="/ChefNextDoor/uploads/dishes/<?= htmlspecialchars($d['image']) ?>"
                                 alt="<?= htmlspecialchars($d['title']) ?>"
                                 class="w-full h-44 object-cover" />
                        <?php else: ?>
                            <div class="w-full h-44 bg-brand-50 flex items-center justify-center text-5xl">🍽️</div>
                        <?php endif; ?>

                        <div class="p-4">
                            <div class="flex items-start justify-between mb-1">
                                <h3 class="font-semibold text-gray-800"><?= htmlspecialchars($d['title']) ?></h3>
                                <span class="text-brand-600 font-bold text-sm ml-2">৳<?= number_format($d['price'], 2) ?></span>
                            </div>
                            <p class="text-xs text-gray-400 mb-1">👨‍🍳 <?= htmlspecialchars($d['chef_name']) ?></p>
                            <p class="text-xs text-gray-500 line-clamp-2 mb-3"><?= htmlspecialchars($d['description'] ?? '') ?></p>

                            <div class="flex items-center justify-between">
                                <span class="text-xs px-2 py-0.5 rounded-full bg-brand-50 text-brand-600">
                                    <?= htmlspecialchars($d['category'] ?? 'Other') ?>
                                </span>
                                <form method="POST" action="<?= url('/cart/add') ?>">
                                    <input type="hidden" name="dish_id" value="<?= $d['id'] ?>" />
                                    <button type="submit"
                                        class="text-xs bg-brand-500 hover:bg-brand-600 text-white px-3 py-1.5 rounded-xl font-medium transition-colors">
                                        + Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
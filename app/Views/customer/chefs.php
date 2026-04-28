<?php
use App\Core\Session;
$title = 'Browse Chefs | ChefNextDoor';
ob_start();
?>
<div class="min-h-screen bg-brand-50">
    <nav class="bg-white border-b border-brand-100 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <img src="/ChefNextDoor/assets/images/chefnextdoor_logo.jpeg" alt="ChefNextDoor" class="w-8 h-8 object-contain" />
            <span class="text-lg font-bold text-brand-600">ChefNextDoor</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="<?= url('/cart') ?>" class="text-sm text-gray-500 hover:text-brand-600">
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

    <div class="max-w-3xl mx-auto px-6 py-10">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">👨‍🍳 Choose a Chef</h1>
        <p class="text-sm text-gray-400 mb-6">Pick a home chef and explore their menu</p>

        <?php if (empty($chefs)): ?>
            <div class="bg-white rounded-2xl border border-brand-100 p-12 text-center">
                <div class="text-5xl mb-4">👨‍🍳</div>
                <h2 class="text-lg font-semibold text-gray-700">No chefs available yet</h2>
                <p class="text-sm text-gray-400 mt-1">Check back soon!</p>
            </div>
        <?php else: ?>
            <div class="space-y-3">
                <?php foreach ($chefs as $chef): ?>
                    <a href="<?= url('/chef-menu?id=' . $chef['id']) ?>"
                       class="bg-white rounded-2xl border border-brand-100 p-5 flex items-center gap-4 hover:border-brand-400 hover:shadow-sm transition-all group">
                        <div class="w-14 h-14 rounded-full bg-brand-100 flex items-center justify-center text-2xl font-bold text-brand-600 shrink-0">
                            <?= strtoupper(substr($chef['name'], 0, 1)) ?>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800 group-hover:text-brand-600"><?= htmlspecialchars($chef['name']) ?></h3>
                            <?php if ($chef['specialty']): ?>
                                <p class="text-xs text-brand-600 font-medium mt-0.5"><?= htmlspecialchars($chef['specialty']) ?></p>
                            <?php endif; ?>
                            <?php if ($chef['bio']): ?>
                                <p class="text-xs text-gray-400 mt-1 line-clamp-1"><?= htmlspecialchars($chef['bio']) ?></p>
                            <?php endif; ?>
                            <?php if ($chef['location']): ?>
                                <p class="text-xs text-gray-400 mt-0.5">📍 <?= htmlspecialchars($chef['location']) ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="text-right shrink-0">
                            <?php if ($chef['avg_rating'] > 0): ?>
                                <p class="text-sm font-bold text-yellow-500">⭐ <?= number_format($chef['avg_rating'], 1) ?></p>
                                <p class="text-xs text-gray-400"><?= $chef['review_count'] ?> reviews</p>
                            <?php else: ?>
                                <p class="text-xs text-gray-300">No reviews yet</p>
                            <?php endif; ?>
                            <span class="text-brand-400 text-lg mt-1 block">→</span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
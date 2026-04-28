<?php
use App\Core\Session;
$title = htmlspecialchars($chef['name']) . "'s Kitchen | ChefNextDoor";
ob_start();
?>
<div class="min-h-screen bg-brand-50">
    <nav class="bg-white border-b border-brand-100 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-2xl">🍳</span>
            <span class="text-lg font-bold text-brand-600">ChefNextDoor</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="<?= url('/cart') ?>" class="text-sm text-gray-500 hover:text-brand-600">
                🛒 Cart
                <?php $cartCount = array_sum(array_column($cart, 'quantity')); ?>
                <?php if ($cartCount > 0): ?>
                    <span class="ml-1 bg-brand-500 text-white text-xs px-1.5 py-0.5 rounded-full"><?= $cartCount ?></span>
                <?php endif; ?>
            </a>
            <a href="<?= url('/chefs') ?>" class="text-sm text-gray-500 hover:text-brand-600">← Chefs</a>
            <a href="<?= url('/logout') ?>" class="text-sm bg-brand-500 hover:bg-brand-600 text-white px-4 py-2 rounded-xl font-medium transition-colors">Logout</a>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-6 py-10">

        <?php if (Session::get('success')): ?>
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                <?= htmlspecialchars(Session::get('success')) ?>
                <?php Session::remove('success'); ?>
            </div>
        <?php endif; ?>

        <!-- Chef header -->
        <div class="bg-white rounded-2xl border border-brand-100 p-6 mb-6">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-16 h-16 rounded-full bg-brand-100 flex items-center justify-center text-3xl font-bold text-brand-600">
                    <?= strtoupper(substr($chef['name'], 0, 1)) ?>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($chef['name']) ?>'s Kitchen</h1>
                    <?php if ($chef['specialty']): ?>
                        <p class="text-sm text-brand-600 font-medium"><?= htmlspecialchars($chef['specialty']) ?></p>
                    <?php endif; ?>
                    <?php if ($chef['avg_rating'] > 0): ?>
                        <p class="text-sm text-yellow-500 font-medium">⭐ <?= number_format($chef['avg_rating'], 1) ?> (<?= $chef['review_count'] ?> reviews)</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($chef['bio']): ?>
                <p class="text-sm text-gray-500"><?= htmlspecialchars($chef['bio']) ?></p>
            <?php endif; ?>
        </div>

        <!-- Dishes -->
        <?php if (empty($dishes)): ?>
            <div class="bg-white rounded-2xl border border-brand-100 p-12 text-center">
                <div class="text-5xl mb-4">🍽️</div>
                <h2 class="text-lg font-semibold text-gray-700">No dishes available</h2>
                <p class="text-sm text-gray-400 mt-1">This chef hasn't added any dishes yet.</p>
            </div>
        <?php else: ?>
            <div class="space-y-4">
                <?php foreach ($dishes as $d): ?>
                    <?php $inCart = $cart[$d['id']]['quantity'] ?? 0; ?>
                    <div class="bg-white rounded-2xl border border-brand-100 overflow-hidden">
                        <?php if ($d['image']): ?>
                            <img src="/ChefNextDoor/uploads/dishes/<?= htmlspecialchars($d['image']) ?>"
                                 alt="<?= htmlspecialchars($d['title']) ?>"
                                 class="w-full h-44 object-cover" />
                        <?php endif; ?>
                        <div class="p-4">
                            <div class="flex items-start justify-between mb-1">
                                <h3 class="font-semibold text-gray-800"><?= htmlspecialchars($d['title']) ?></h3>
                                <span class="text-brand-600 font-bold ml-2">৳<?= number_format($d['price'], 0) ?></span>
                            </div>
                            <p class="text-xs text-gray-400 mb-4"><?= htmlspecialchars($d['description'] ?? '') ?></p>

                            <!-- Quantity selector -->
                            <div class="flex items-center justify-between">
                                <span class="text-xs px-2 py-0.5 rounded-full bg-brand-50 text-brand-600">
                                    <?= htmlspecialchars($d['category'] ?? 'Other') ?>
                                </span>
                                <div class="flex items-center gap-3">
                                    <?php if ($inCart > 0): ?>
                                        <form method="POST" action="<?= url('/cart/update') ?>" class="flex items-center gap-2">
                                            <input type="hidden" name="dish_id" value="<?= $d['id'] ?>" />
                                            <input type="hidden" name="quantity" value="<?= $inCart - 1 ?>" />
                                            <button type="submit" class="w-8 h-8 rounded-full bg-brand-500 text-white font-bold text-lg flex items-center justify-center hover:bg-brand-600 transition-colors">−</button>
                                        </form>
                                        <span class="font-semibold text-gray-800 w-4 text-center"><?= $inCart ?></span>
                                    <?php else: ?>
                                        <span class="w-8 h-8"></span>
                                        <span class="font-semibold text-gray-300 w-4 text-center">0</span>
                                    <?php endif; ?>
                                    <form method="POST" action="<?= url('/cart/add') ?>">
                                        <input type="hidden" name="dish_id" value="<?= $d['id'] ?>" />
                                        <button type="submit" class="w-8 h-8 rounded-full bg-brand-500 text-white font-bold text-lg flex items-center justify-center hover:bg-brand-600 transition-colors">+</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Proceed to cart -->
            <?php if ($cartCount > 0): ?>
                <div class="mt-6 sticky bottom-4">
                    <a href="<?= url('/cart') ?>"
                        class="block w-full text-center bg-brand-500 hover:bg-brand-600 text-white font-semibold py-3 rounded-xl transition-colors shadow-lg">
                        View Cart (<?= $cartCount ?> items) →
                    </a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
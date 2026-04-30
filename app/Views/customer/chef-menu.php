<?php
use App\Core\Session;

/**
 * ✅ FIX: Ensure variables exist (prevents undefined errors)
 */
$chef   = $data['chef'] ?? null;
$cart   = $data['cart'] ?? [];
$dishes = $data['dishes'] ?? [];
$user   = $data['user'] ?? null;

/**
 * ✅ Safety check
 */
if (!$chef) {
    echo "<p class='text-center mt-10 text-red-500'>Chef not found.</p>";
    return;
}

$title = htmlspecialchars($chef['name']) . "'s Kitchen | ChefNextDoor";
ob_start();
?>

<div class="min-h-screen bg-brand-50">

    <!-- ✅ Responsive Navbar -->
    <nav class="bg-white border-b border-brand-100 px-4 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="flex items-center gap-2">
            <img src="/ChefNextDoor/assets/images/chefnextdoor_logo.jpeg" class="w-8 h-8 object-contain" />
            <span class="text-lg font-bold text-brand-600">ChefNextDoor</span>
        </div>

        <div class="flex flex-wrap items-center gap-3 text-sm">
            <a href="<?= url('/cart') ?>" class="text-gray-500 hover:text-brand-600">
                🛒 Cart
                <?php $cartCount = array_sum(array_column($cart, 'quantity')); ?>
                <?php if ($cartCount > 0): ?>
                    <span class="ml-1 bg-brand-500 text-white text-xs px-1.5 py-0.5 rounded-full">
                        <?= $cartCount ?>
                    </span>
                <?php endif; ?>
            </a>

            <a href="<?= url('/chefs') ?>" class="text-gray-500 hover:text-brand-600">← Chefs</a>

            <a href="<?= url('/logout') ?>"
               class="bg-brand-500 hover:bg-brand-600 text-white px-4 py-2 rounded-xl font-medium">
               Logout
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-2xl mx-auto px-4 sm:px-6 py-8 sm:py-10">

        <!-- Success Message -->
        <?php if (Session::get('success')): ?>
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                <?= e(Session::get('success')) ?>
                <?php Session::remove('success'); ?>
            </div>
        <?php endif; ?>

        <!-- Chef Header -->
        <div class="bg-white rounded-2xl border border-brand-100 p-4 sm:p-6 mb-6">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-brand-100 flex items-center justify-center text-2xl sm:text-3xl font-bold text-brand-600">
                    <?= strtoupper(substr($chef['name'], 0, 1)) ?>
                </div>

                <div>
                    <h1 class="text-lg sm:text-xl font-bold text-gray-800">
                        <?= e($chef['name']) ?>'s Kitchen
                    </h1>

                    <?php if (!empty($chef['specialty'])): ?>
                        <p class="text-sm text-brand-600"><?= e($chef['specialty']) ?></p>
                    <?php endif; ?>

                    <?php if (!empty($chef['avg_rating'])): ?>
                        <p class="text-sm text-yellow-500">
                            ⭐ <?= number_format($chef['avg_rating'], 1) ?>
                            (<?= $chef['review_count'] ?> reviews)
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (!empty($chef['bio'])): ?>
                <p class="text-sm text-gray-500"><?= e($chef['bio']) ?></p>
            <?php endif; ?>
        </div>

        <!-- Search -->
        <div class="mb-5">
            <div class="relative">
                <input type="text" id="dishSearch"
                       placeholder="Search dishes..."
                       class="w-full px-4 py-3 pl-10 rounded-xl border border-brand-100 focus:ring-2 focus:ring-brand-400 text-sm" />
                <span class="absolute left-3 top-3.5 text-gray-400">🔍</span>
            </div>
        </div>

        <!-- Dishes -->
        <div id="dishesContainer">

            <?php if (empty($dishes)): ?>
                <div class="bg-white rounded-2xl border border-brand-100 p-10 text-center">
                    <div class="text-5xl mb-4">🍽️</div>
                    <h2 class="text-lg font-semibold text-gray-700">No dishes available</h2>
                </div>

            <?php else: ?>
                <div class="space-y-4">

                    <?php foreach ($dishes as $d): ?>
                        <?php $inCart = $cart[$d['id']]['quantity'] ?? 0; ?>

                        <div class="bg-white rounded-2xl border border-brand-100 overflow-hidden">

                            <?php if (!empty($d['image'])): ?>
                                <img src="/ChefNextDoor/uploads/dishes/<?= e($d['image']) ?>"
                                     class="w-full h-40 sm:h-44 object-cover" />
                            <?php endif; ?>

                            <div class="p-4">

                                <div class="flex justify-between mb-1">
                                    <h3 class="font-semibold"><?= e($d['title']) ?></h3>
                                    <span class="text-brand-600 font-bold">৳<?= number_format($d['price']) ?></span>
                                </div>

                                <p class="text-xs text-gray-400 mb-3">
                                    <?= e($d['description'] ?? '') ?>
                                </p>

                                <div class="flex justify-between items-center">

                                    <span class="text-xs bg-brand-50 px-2 py-1 rounded">
                                        <?= e($d['category'] ?? 'Other') ?>
                                    </span>

                                    <div class="flex items-center gap-2">

                                        <?php if ($inCart > 0): ?>
                                            <form method="POST" action="<?= url('/cart/update') ?>">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="dish_id" value="<?= $d['id'] ?>">
                                                <input type="hidden" name="quantity" value="<?= $inCart - 1 ?>">
                                                <button class="w-8 h-8 bg-brand-500 text-white rounded-full">−</button>
                                            </form>

                                            <span><?= $inCart ?></span>
                                        <?php endif; ?>

                                        <form method="POST" action="<?= url('/cart/add') ?>">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="dish_id" value="<?= $d['id'] ?>">
                                            <button class="w-8 h-8 bg-brand-500 text-white rounded-full">+</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Cart Button -->
                <?php if (!empty($cart)): ?>
                    <div class="mt-6 sticky bottom-4">
                        <a href="<?= url('/cart') ?>"
                           class="block text-center bg-brand-500 text-white py-3 rounded-xl">
                           View Cart →
                        </a>
                    </div>
                <?php endif; ?>

            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>
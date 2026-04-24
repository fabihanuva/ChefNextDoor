<?php
use App\Core\Session;
$title = 'My Cart | ChefNextDoor';
ob_start();
?>
<div class="min-h-screen bg-brand-50">
    <nav class="bg-white border-b border-orange-100 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-2xl">🍳</span>
            <span class="text-lg font-bold text-brand-600">ChefNextDoor</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="<?= url('/browse') ?>" class="text-sm text-gray-500 hover:text-brand-600">← Browse</a>
            <a href="<?= url('/logout') ?>" class="text-sm bg-brand-500 hover:bg-brand-600 text-white px-4 py-2 rounded-xl font-medium transition-colors">Logout</a>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-6 py-10">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">🛒 My Cart</h1>

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

        <?php if (empty($cart)): ?>
            <div class="bg-white rounded-2xl border border-orange-100 p-12 text-center">
                <div class="text-5xl mb-4">🛒</div>
                <h2 class="text-lg font-semibold text-gray-700">Your cart is empty</h2>
                <p class="text-sm text-gray-400 mt-1 mb-5">Add some delicious dishes!</p>
                <a href="<?= url('/browse') ?>"
                    class="bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">
                    Browse Dishes
                </a>
            </div>
        <?php else: ?>
            <div class="space-y-3 mb-6">
                <?php foreach ($cart as $item): ?>
                    <div class="bg-white rounded-2xl border border-orange-100 p-4 flex items-center gap-4">
                        <?php if ($item['image']): ?>
                            <img src="/ChefNextDoor/uploads/dishes/<?= htmlspecialchars($item['image']) ?>"
                                 class="w-16 h-16 rounded-xl object-cover" />
                        <?php else: ?>
                            <div class="w-16 h-16 rounded-xl bg-brand-50 flex items-center justify-center text-2xl">🍽️</div>
                        <?php endif; ?>

                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800 text-sm"><?= htmlspecialchars($item['title']) ?></h3>
                            <p class="text-brand-600 font-bold text-sm">৳<?= number_format($item['price'], 2) ?></p>
                        </div>

                        <div class="flex items-center gap-2">
                            <form method="POST" action="<?= url('/cart/update') ?>" class="flex items-center gap-2">
                                <input type="hidden" name="dish_id" value="<?= $item['id'] ?>" />
                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="0"
                                    class="w-14 text-center px-2 py-1 border border-gray-200 rounded-lg text-sm" />
                                <button type="submit" class="text-xs text-brand-600 hover:underline">Update</button>
                            </form>

                            <form method="POST" action="<?= url('/cart/remove') ?>">
                                <input type="hidden" name="dish_id" value="<?= $item['id'] ?>" />
                                <button type="submit" class="text-red-400 hover:text-red-600 text-sm">🗑️</button>
                            </form>
                        </div>

                        <div class="text-right min-w-[60px]">
                            <p class="font-bold text-gray-800 text-sm">৳<?= number_format($item['price'] * $item['quantity'], 2) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Total -->
            <div class="bg-white rounded-2xl border border-orange-100 p-5 mb-4">
                <div class="flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Total</span>
                    <span class="text-xl font-bold text-brand-600">৳<?= number_format($total, 2) ?></span>
                </div>
            </div>

            <a href="<?= url('/checkout') ?>"
                class="block w-full text-center bg-brand-500 hover:bg-brand-600 text-white font-semibold py-3 rounded-xl transition-colors">
                Proceed to Checkout →
            </a>
        <?php endif; ?>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
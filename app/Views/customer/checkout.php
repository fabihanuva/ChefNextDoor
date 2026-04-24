<?php
use App\Core\Session;
$title = 'Checkout | ChefNextDoor';
ob_start();
?>
<div class="min-h-screen bg-brand-50">
    <nav class="bg-white border-b border-orange-100 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-2xl">🍳</span>
            <span class="text-lg font-bold text-brand-600">ChefNextDoor</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="<?= url('/cart') ?>" class="text-sm text-gray-500 hover:text-brand-600">← Cart</a>
            <a href="<?= url('/logout') ?>" class="text-sm bg-brand-500 hover:bg-brand-600 text-white px-4 py-2 rounded-xl font-medium transition-colors">Logout</a>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-6 py-10">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">📦 Checkout</h1>

        <?php if (Session::get('error')): ?>
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                <?= htmlspecialchars(Session::get('error')) ?>
                <?php Session::remove('error'); ?>
            </div>
        <?php endif; ?>

        <!-- Order summary -->
        <div class="bg-white rounded-2xl border border-orange-100 p-5 mb-5">
            <h2 class="font-semibold text-gray-700 mb-3">Order Summary</h2>
            <div class="space-y-2">
                <?php foreach ($cart as $item): ?>
                    <div class="flex justify-between text-sm text-gray-600">
                        <span><?= htmlspecialchars($item['title']) ?> × <?= $item['quantity'] ?></span>
                        <span class="font-medium">৳<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                    </div>
                <?php endforeach; ?>
                <div class="border-t border-gray-100 pt-2 flex justify-between font-bold text-gray-800">
                    <span>Total</span>
                    <span class="text-brand-600">৳<?= number_format($total, 2) ?></span>
                </div>
            </div>
        </div>

        <!-- Delivery form -->
        <div class="bg-white rounded-2xl border border-orange-100 p-5">
            <h2 class="font-semibold text-gray-700 mb-3">Delivery Details</h2>
            <form method="POST" action="<?= url('/order/place') ?>" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" value="<?= htmlspecialchars($user['name']) ?>" disabled
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm text-gray-500" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Delivery Address *</label>
                    <textarea name="address" rows="3" required placeholder="Enter your full delivery address..."
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm resize-none"></textarea>
                </div>
                <button type="submit"
                    class="w-full bg-brand-500 hover:bg-brand-600 text-white font-semibold py-3 rounded-xl transition-colors">
                    Place Order 🎉
                </button>
            </form>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
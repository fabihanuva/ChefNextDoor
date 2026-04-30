<?php
use App\Core\Session;
$title = 'My Cart | ChefNextDoor';
ob_start();
?>

<?php include __DIR__ . '/../partials/navbar.php'; ?>

<div class="max-w-4xl mx-auto px-4 sm:px-6 py-8 sm:py-12">
    <div class="flex items-center gap-4 mb-8">
        <a href="<?= url('/chefs') ?>" class="p-2 rounded-full hover:bg-white transition-colors text-gray-400 hover:text-brand-600">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">Shopping Cart</h1>
    </div>

    <?php if (empty($cart)): ?>
        <div class="card-base p-12 sm:p-20 text-center">
            <div class="w-20 h-20 sm:w-24 sm:h-24 bg-brand-50 rounded-full flex items-center justify-center text-4xl sm:text-5xl mx-auto mb-6">🛒</div>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Your cart is empty</h2>
            <p class="text-gray-500 max-w-sm mx-auto mb-8 text-sm">Looks like you haven't added any home-cooked goodness yet.</p>
            <a href="<?= url('/chefs') ?>" class="btn-primary">Browse Delicious Dishes</a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-10">

            <!-- Items List -->
            <div class="lg:col-span-2 space-y-4">
                <?php foreach ($cart as $item): ?>
                    <div class="card-base p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        <div class="w-full sm:w-20 h-36 sm:h-20 shrink-0 rounded-2xl overflow-hidden bg-gray-100">
                            <?php if ($item['image']): ?>
                                <img src="/ChefNextDoor/uploads/dishes/<?= htmlspecialchars($item['image']) ?>"
                                     class="w-full h-full object-cover" />
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-3xl">🍲</div>
                            <?php endif; ?>
                        </div>

                        <div class="flex-1 w-full">
                            <div class="flex items-start justify-between gap-2">
                                <h3 class="font-bold text-gray-800"><?= htmlspecialchars($item['title']) ?></h3>
                                <p class="font-black text-brand-600 shrink-0">৳<?= number_format($item['price'] * $item['quantity'], 0) ?></p>
                            </div>
                            <p class="text-brand-500 font-medium text-sm mt-0.5">৳<?= number_format($item['price'], 0) ?> each</p>

                            <div class="flex items-center gap-3 mt-3 flex-wrap">
                                <div class="flex items-center bg-gray-50 rounded-lg p-1 border border-gray-100 gap-2">
                                    <form method="POST" action="<?= url('/cart/update') ?>">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="dish_id" value="<?= $item['id'] ?>" />
                                        <input type="hidden" name="quantity" value="<?= $item['quantity'] - 1 ?>" />
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center bg-white border border-gray-200 rounded-md text-brand-600 font-bold hover:bg-brand-50 transition-colors">−</button>
                                    </form>
                                    <span class="text-sm font-bold text-gray-700 min-w-[1.5rem] text-center"><?= $item['quantity'] ?></span>
                                    <form method="POST" action="<?= url('/cart/update') ?>">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="dish_id" value="<?= $item['id'] ?>" />
                                        <input type="hidden" name="quantity" value="<?= $item['quantity'] + 1 ?>" />
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center bg-brand-500 border border-brand-500 rounded-md text-white font-bold hover:bg-brand-600 transition-colors">+</button>
                                    </form>
                                </div>

                                <form method="POST" action="<?= url('/cart/remove') ?>">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="dish_id" value="<?= $item['id'] ?>" />
                                    <button type="submit" class="p-2 text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Summary -->
            <div class="lg:col-span-1">
                <div class="card-base p-5 mb-4 sticky top-20">
                    <h2 class="font-bold text-gray-800 mb-4">Order Summary</h2>
                    <div class="flex justify-between items-center text-sm text-gray-500 mb-2">
                        <span>Subtotal</span>
                        <span>৳<?= number_format($subtotal, 0) ?></span>
                    </div>
                    <div class="flex justify-between items-center text-sm text-gray-500 mb-3">
                        <span>Delivery Fee</span>
                        <span>৳<?= number_format($deliveryFee, 0) ?></span>
                    </div>
                    <div class="border-t border-gray-100 pt-3 flex justify-between items-center mb-5">
                        <span class="font-bold text-gray-800">Grand Total</span>
                        <span class="text-xl font-black text-brand-600">৳<?= number_format($total, 0) ?></span>
                    </div>
                    <a href="<?= url('/checkout') ?>"
                        class="block w-full text-center bg-brand-500 hover:bg-brand-600 text-white font-semibold py-3 rounded-xl transition-colors">
                        Confirm Order →
                    </a>
                </div>
            </div>

        </div>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
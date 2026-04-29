<?php
use App\Core\Session;
$title = 'My Cart | ChefNextDoor';
ob_start();
?>
<div class="max-w-4xl mx-auto px-6 py-12">
    <div class="flex items-center gap-4 mb-10">
        <a href="<?= url('/browse') ?>" class="p-2 rounded-full hover:bg-white transition-colors text-slate-400 hover:text-brand-600">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Shopping Cart</h1>
    </div>

    <?php if (empty($cart)): ?>
        <div class="card-base p-20 text-center">
            <div class="w-24 h-24 bg-brand-50 rounded-full flex items-center justify-center text-5xl mx-auto mb-6">🛒</div>
            <h2 class="text-2xl font-bold text-slate-800 mb-2">Your cart is empty</h2>
            <p class="text-slate-500 max-w-sm mx-auto mb-8">Looks like you haven't added any home-cooked goodness to your cart yet.</p>
            <a href="<?= url('/browse') ?>" class="btn-primary">
                Browse Delicious Dishes
            </a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Items List -->
            <div class="lg:col-span-2 space-y-4">
                <?php foreach ($cart as $item): ?>
                    <div class="card-base p-5 flex items-center gap-6">
                        <div class="w-20 h-20 shrink-0 rounded-2xl overflow-hidden bg-slate-100">
                            <?php if ($item['image']): ?>
                                <img src="/ChefNextDoor/uploads/dishes/<?= e($item['image']) ?>"
                                     class="w-full h-full object-cover" />
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-3xl">🍲</div>
                            <?php endif; ?>
                        </div>

                        <div class="flex-grow">
                            <h3 class="font-bold text-slate-800"><?= e($item['title']) ?></h3>
                            <p class="text-brand-600 font-black text-sm mt-1">৳<?= number_format($item['price'], 0) ?></p>
                            
                            <div class="flex items-center gap-4 mt-3">
                                <form method="POST" action="<?= url('/cart/update') ?>" class="flex items-center bg-slate-50 rounded-lg p-1 border border-slate-100">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="dish_id" value="<?= $id ?>" />
                                    <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="0"
                                        class="w-12 bg-transparent text-center text-sm font-bold text-slate-700 outline-none" />
                                    <button type="submit" class="text-[10px] font-black uppercase text-brand-600 px-2 hover:bg-white rounded-md transition-colors">Update</button>
                                </form>

                                <form method="POST" action="<?= url('/cart/remove') ?>">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="dish_id" value="<?= $id ?>" />
                                    <button type="submit" class="text-slate-300 hover:text-red-500 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="text-right">
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter mb-1">Subtotal</p>
                            <p class="font-black text-slate-800">৳<?= number_format($item['price'] * $item['quantity'], 0) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Total -->
            <div class="bg-white rounded-2xl border border-brand-100 p-5 mb-4">
                <div class="flex justify-between items-center text-sm text-gray-500 mb-2">
                    <span>Subtotal</span>
                    <span>৳<?= number_format($subtotal, 2) ?></span>
                </div>
                    <div class="flex justify-between items-center text-sm text-gray-500 mb-3">
                        <span>Delivery Fee</span>
                        <span>৳<?= number_format($deliveryFee, 2) ?></span>
                    </div>
                <div class="border-t border-gray-100 pt-3 flex justify-between items-center">
                    <span class="font-bold text-gray-800">Grand Total</span>
                    <span class="text-xl font-bold text-brand-600">৳<?= number_format($total, 2) ?></span>
                </div>
            </div>

            <a href="<?= url('/checkout') ?>"
            class="block w-full text-center bg-brand-500 hover:bg-brand-600 text-white font-semibold py-3 rounded-xl transition-colors">
            Confirm Order →
            </a>
        </div>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';

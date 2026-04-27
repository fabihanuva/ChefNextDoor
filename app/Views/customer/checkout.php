<?php
use App\Core\Session;
$title = 'Checkout | ChefNextDoor';
ob_start();
?>
<div class="max-w-4xl mx-auto px-6 py-12">
    <div class="flex items-center gap-4 mb-10">
        <a href="<?= url('/cart') ?>" class="p-2 rounded-full hover:bg-white transition-colors text-slate-400 hover:text-brand-600">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Checkout</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <!-- Delivery Details -->
        <div class="space-y-8">
            <div class="card-base p-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-500 to-orange-400"></div>
                <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand-600"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    Delivery Details
                </h2>
                
                <form method="POST" action="<?= url('/order/place') ?>" class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Recipient Name</label>
                        <input type="text" value="<?= htmlspecialchars($user['name']) ?>" disabled
                            class="input-base bg-slate-50 border-slate-100 text-slate-400" />
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Delivery Address *</label>
                        <textarea name="address" rows="4" required placeholder="Apartment, Street, Area, City..."
                            class="input-base resize-none"></textarea>
                        <p class="text-[10px] text-slate-400 mt-2 italic">Our chefs will use this address to deliver your meal freshly prepared.</p>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="btn-primary w-full py-4 text-base flex items-center justify-center gap-2 group">
                            Place Your Order
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 transition-transform"><path d="m5 12 7-7 7 7"/><path d="M12 19V5"/></svg>
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="card-base p-6 bg-slate-50/50 border-dashed">
                <div class="flex items-center gap-3 text-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    <p class="text-xs font-medium">Safe and secure payment options available upon delivery.</p>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div>
            <div class="card-base p-8 sticky top-24">
                <h2 class="text-xl font-bold text-slate-800 mb-6">Order Summary</h2>
                
                <div class="space-y-4 max-h-[40vh] overflow-y-auto mb-8 pr-2">
                    <?php foreach ($cart as $item): ?>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 shrink-0 overflow-hidden">
                                <?php if ($item['image']): ?>
                                    <img src="/ChefNextDoor/uploads/dishes/<?= htmlspecialchars($item['image']) ?>" class="w-full h-full object-cover" />
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center text-xl">🍲</div>
                                <?php endif; ?>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm font-bold text-slate-800 line-clamp-1"><?= htmlspecialchars($item['title']) ?></p>
                                <p class="text-xs text-slate-500"><?= $item['quantity'] ?> × ৳<?= number_format($item['price'], 0) ?></p>
                            </div>
                            <p class="text-sm font-bold text-slate-800">৳<?= number_format($item['price'] * $item['quantity'], 0) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="space-y-3 pt-6 border-t border-gray-100">
                    <div class="flex justify-between text-slate-500 text-sm">
                        <span>Subtotal</span>
                        <span>৳<?= number_format($total, 0) ?></span>
                    </div>
                    <div class="flex justify-between text-slate-500 text-sm">
                        <span>Delivery</span>
                        <span class="text-green-600 font-bold uppercase tracking-widest text-[10px]">Free</span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-50">
                        <span class="font-bold text-slate-800">Final Total</span>
                        <span class="text-2xl font-black text-brand-600">৳<?= number_format($total, 0) ?></span>
                    </div>
                </div>

                <div class="mt-8 p-4 rounded-xl bg-orange-50 border border-orange-100">
                    <div class="flex gap-3">
                        <div class="text-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                        <p class="text-xs text-orange-700 leading-relaxed font-medium">
                            By placing your order, you agree to our delivery policies. Your meal will be freshly prepared by the chef.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';

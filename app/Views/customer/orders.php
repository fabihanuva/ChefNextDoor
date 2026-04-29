<?php
use App\Core\Session;
use App\Models\Review;
$title = 'My Orders | ChefNextDoor';
ob_start();
?>

<!-- Navbar -->
<nav class="bg-white border-b border-brand-100 px-6 py-4 flex items-center justify-between">
    <div class="flex items-center gap-2">
        <img src="/ChefNextDoor/assets/images/chefnextdoor_logo.jpeg" alt="ChefNextDoor" class="w-8 h-8 object-contain" />
        <span class="text-lg font-bold text-brand-600">ChefNextDoor</span>
    </div>
    <div class="flex items-center gap-3">
        <?php $cartCount = array_sum(array_column(Session::get('cart') ?? [], 'quantity')); ?>
        <a href="<?= url('/cart') ?>" class="text-sm text-gray-500 hover:text-brand-600">
            🛒 Cart
            <?php if ($cartCount > 0): ?>
                <span class="ml-1 bg-brand-500 text-white text-xs px-1.5 py-0.5 rounded-full"><?= $cartCount ?></span>
            <?php endif; ?>
        </a>
        <a href="<?= url('/dashboard') ?>" class="text-sm text-gray-500 hover:text-brand-600">← Dashboard</a>
        <a href="<?= url('/logout') ?>"
           class="text-sm bg-brand-500 hover:bg-brand-600 text-white px-4 py-2 rounded-xl font-medium transition-colors">
            Logout
        </a>
    </div>
</nav>

<div class="max-w-4xl mx-auto px-6 py-12">
    <div class="flex items-center gap-4 mb-10">
        <a href="<?= url('/dashboard') ?>" class="p-2 rounded-full hover:bg-white transition-colors text-gray-400 hover:text-brand-600">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Order History</h1>
    </div>

    <?php if (empty($orders)): ?>
        <div class="card-base p-20 text-center">
            <div class="w-24 h-24 bg-brand-50 rounded-full flex items-center justify-center text-5xl mx-auto mb-6">📦</div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">No orders yet</h2>
            <p class="text-gray-500 max-w-sm mx-auto mb-8">Ready to taste something amazing? Browse our chef-crafted menu and place your first order.</p>
            <a href="<?= url('/chefs') ?>" class="btn-primary">Browse Dishes</a>
        </div>
    <?php else: ?>
        <div class="space-y-8">
            <?php foreach ($orders as $order): ?>
                <?php
                $steps = [
                    'pending'          => 1,
                    'accepted'         => 2,
                    'preparing'        => 3,
                    'out_for_delivery' => 4,
                    'delivered'        => 5
                ];
                $currentStep = $steps[$order['status']] ?? 0;
                $isCancelled = ($order['status'] === 'cancelled');
                $statusColors = [
                    'pending'          => 'text-yellow-600 bg-yellow-50',
                    'accepted'         => 'text-blue-600 bg-blue-50',
                    'preparing'        => 'text-purple-600 bg-purple-50',
                    'out_for_delivery' => 'text-orange-600 bg-orange-50',
                    'delivered'        => 'text-green-600 bg-green-50',
                    'cancelled'        => 'text-red-600 bg-red-50',
                ];
                ?>
                <div class="card-base p-8">
                    <div class="flex flex-col md:flex-row justify-between gap-6 mb-8 pb-6 border-b border-gray-50">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-brand-50 flex items-center justify-center text-2xl">📦</div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-lg">Order #<?= $order['id'] ?></h3>
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mt-0.5">
                                    Placed on <?= date('d M Y, h:i A', strtotime($order['created_at'])) ?>
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col md:items-end justify-center">
                            <span class="px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest <?= $statusColors[$order['status']] ?? 'text-gray-500 bg-gray-50' ?>">
                                <?= str_replace('_', ' ', $order['status']) ?>
                            </span>
                            <p class="text-xl font-black text-brand-600 mt-2">৳<?= number_format($order['total_price'], 0) ?></p>
                        </div>
                    </div>

                    <?php if (!$isCancelled): ?>
                    <!-- Progress Bar -->
                    <div class="mb-10 px-4">
                        <div class="relative flex items-center justify-between">
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-gray-100 rounded-full"></div>
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-brand-500 rounded-full transition-all duration-1000"
                                 style="width: <?= (($currentStep - 1) / 4) * 100 ?>%"></div>
                            <?php
                            $stepLabels = [
                                ['label' => 'Pending',    'icon' => '⏳'],
                                ['label' => 'Accepted',   'icon' => '✅'],
                                ['label' => 'Preparing',  'icon' => '👨‍🍳'],
                                ['label' => 'On the way', 'icon' => '🚴'],
                                ['label' => 'Delivered',  'icon' => '🏠'],
                            ];
                            foreach ($stepLabels as $index => $step):
                                $stepNum  = $index + 1;
                                $isActive = $stepNum <= $currentStep;
                            ?>
                                <div class="relative z-10 flex flex-col items-center">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs transition-all duration-300 <?= $isActive ? 'bg-brand-500 text-white shadow-lg' : 'bg-white border-2 border-gray-100 text-gray-300' ?>">
                                        <?= $isActive ? '✓' : $stepNum ?>
                                    </div>
                                    <div class="absolute top-10 whitespace-nowrap text-center">
                                        <p class="text-[10px] font-bold uppercase tracking-tighter <?= $isActive ? 'text-brand-600' : 'text-gray-300' ?>">
                                            <?= $step['label'] ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mt-12 pt-6 border-t border-gray-50">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-brand-100 flex items-center justify-center text-sm font-bold text-brand-600">
                                <?= strtoupper(substr($order['chef_name'], 0, 1)) ?>
                            </div>
                            <div class="text-sm">
                                <p class="text-gray-400 font-medium">Prepared by</p>
                                <p class="font-bold text-gray-800">Chef <?= e($order['chef_name']) ?></p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 flex-wrap">
                            <a href="<?= url('/order/track?id=' . $order['id']) ?>"
                                class="text-xs border border-brand-300 text-brand-600 hover:bg-brand-50 px-4 py-2 rounded-xl font-medium transition-colors">
                                📍 Track Order
                            </a>
                            <?php if ($order['status'] === 'delivered' && !Review::alreadyReviewed($order['id'])): ?>
                                <a href="<?= url('/review?order_id=' . $order['id']) ?>"
                                    class="btn-primary !py-2 !text-xs !px-5 flex items-center gap-2">
                                    ⭐ Review Order
                                </a>
                            <?php elseif ($order['status'] === 'delivered'): ?>
                                <div class="flex items-center gap-2 text-green-600 text-xs font-bold px-4 py-2 bg-green-50 rounded-xl">
                                    ✅ Reviewed
                                </div>
                            <?php endif; ?>
                            <div class="text-gray-400 text-xs flex items-center gap-2 max-w-[200px]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span class="truncate"><?= e($order['delivery_address']) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
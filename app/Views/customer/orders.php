<?php
use App\Core\Session;
use App\Models\Review;
$title = 'My Orders | ChefNextDoor';
ob_start();
?>
<div class="max-w-4xl mx-auto px-6 py-12">
    <div class="flex items-center gap-4 mb-10">
        <a href="<?= url('/dashboard') ?>" class="p-2 rounded-full hover:bg-white transition-colors text-slate-400 hover:text-brand-600">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Order History</h1>
    </div>

    <?php if (empty($orders)): ?>
        <div class="card-base p-20 text-center">
            <div class="w-24 h-24 bg-brand-50 rounded-full flex items-center justify-center text-5xl mx-auto mb-6">📦</div>
            <h2 class="text-2xl font-bold text-slate-800 mb-2">No orders yet</h2>
            <p class="text-slate-500 max-w-sm mx-auto mb-8">Ready to taste something amazing? Browse our chef-crafted menu and place your first order.</p>
            <a href="<?= url('/browse') ?>" class="btn-primary">
                Browse Dishes
            </a>
        </div>
    <?php else: ?>
        <div class="space-y-8">
            <?php foreach ($orders as $order): ?>
                <?php
                $steps = [
                    'pending' => 1,
                    'accepted' => 2,
                    'preparing' => 3,
                    'out_for_delivery' => 4,
                    'delivered' => 5
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
                            <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-2xl">
                                📦
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 text-lg">Order #<?= $order['id'] ?></h3>
                                <p class="text-xs text-slate-400 font-medium uppercase tracking-wider mt-0.5">
                                    Placed on <?= date('d M Y, h:i A', strtotime($order['created_at'])) ?>
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col md:items-end justify-center">
                            <span class="px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest <?= $statusColors[$order['status']] ?? 'text-slate-500 bg-slate-50' ?>">
                                <?= str_replace('_', ' ', $order['status']) ?>
                            </span>
                            <p class="text-xl font-black text-brand-600 mt-2">৳<?= number_format($order['total_price'], 0) ?></p>
                        </div>
                    </div>

                    <?php if (!$isCancelled): ?>
                    <!-- Progress Bar -->
                    <div class="mb-10 px-4">
                        <div class="relative flex items-center justify-between">
                            <!-- Progress Line Background -->
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-slate-100 rounded-full"></div>
                            <!-- Active Progress Line -->
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-brand-500 rounded-full transition-all duration-1000" 
                                 style="width: <?= (($currentStep - 1) / 4) * 100 ?>%"></div>
                            
                            <!-- Steps -->
                            <?php 
                            $stepLabels = [
                                ['label' => 'Pending', 'icon' => '⏳'],
                                ['label' => 'Accepted', 'icon' => '✅'],
                                ['label' => 'Preparing', 'icon' => '👨‍🍳'],
                                ['label' => 'On the way', 'icon' => '🚴'],
                                ['label' => 'Delivered', 'icon' => '🏠']
                            ];
                            foreach ($stepLabels as $index => $step): 
                                $stepNum = $index + 1;
                                $isActive = $stepNum <= $currentStep;
                            ?>
                                <div class="relative z-10 flex flex-col items-center">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs transition-all duration-300 <?= $isActive ? 'bg-brand-500 text-white shadow-lg shadow-brand-100' : 'bg-white border-2 border-slate-100 text-slate-300' ?>">
                                        <?= $isActive ? '✓' : $stepNum ?>
                                    </div>
                                    <div class="absolute top-10 whitespace-nowrap text-center">
                                        <p class="text-[10px] font-bold uppercase tracking-tighter <?= $isActive ? 'text-brand-600' : 'text-slate-300' ?>">
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
                            <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-sm font-bold text-slate-500">
                                <?= strtoupper(substr($order['chef_name'], 0, 1)) ?>
                            </div>
                            <div class="text-sm">
                                <p class="text-slate-400 font-medium">Prepared by</p>
                                <a href="<?= url('/chef/profile/public?id=' . $order['chef_id']) ?>" class="font-bold text-slate-800 hover:text-brand-600 transition-colors">
                                    Chef <?= htmlspecialchars($order['chef_name']) ?>
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <?php if ($order['status'] === 'delivered' && !Review::alreadyReviewed($order['id'])): ?>
                                <a href="<?= url('/review?order_id=' . $order['id']) ?>"
                                    class="btn-primary !py-2 !text-xs !px-5 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                    Review Order
                                </a>
                            <?php elseif ($order['status'] === 'delivered'): ?>
                                <div class="flex items-center gap-2 text-green-600 text-xs font-bold px-4 py-2 bg-green-50 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17 4 12"/></svg>
                                    Order Reviewed
                                </div>
                            <?php endif; ?>
                            
                            <div class="text-slate-400 text-xs flex items-center gap-2 max-w-[200px] text-right">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span class="truncate"><?= htmlspecialchars($order['delivery_address']) ?></span>
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

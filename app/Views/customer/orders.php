<?php
use App\Core\Session;
use App\Models\Review;
$title = 'My Orders | ChefNextDoor';
ob_start();
?>

<?php include __DIR__ . '/../partials/navbar.php'; ?>

<div class="max-w-4xl mx-auto px-4 sm:px-6 py-8 sm:py-12">
    <div class="flex items-center gap-4 mb-8">
        <a href="<?= url('/dashboard') ?>" class="p-2 rounded-full hover:bg-white transition-colors text-gray-400 hover:text-brand-600">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">Order History</h1>
    </div>

    <?php if (empty($orders)): ?>
        <div class="card-base p-12 sm:p-20 text-center">
            <div class="w-20 h-20 sm:w-24 sm:h-24 bg-brand-50 rounded-full flex items-center justify-center text-4xl sm:text-5xl mx-auto mb-6">📦</div>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">No orders yet</h2>
            <p class="text-gray-500 max-w-sm mx-auto mb-8 text-sm">Ready to taste something amazing?</p>
            <a href="<?= url('/chefs') ?>" class="btn-primary">Browse Dishes</a>
        </div>
    <?php else: ?>
        <div class="space-y-6 sm:space-y-8">
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
                <div class="card-base p-5 sm:p-8">
                    <div class="flex flex-col sm:flex-row justify-between gap-4 mb-6 pb-6 border-b border-gray-50">
                        <div class="flex items-center gap-3 sm:gap-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-brand-50 flex items-center justify-center text-xl sm:text-2xl shrink-0">📦</div>
                            <div>
                                <h3 class="font-bold text-gray-800">Order #<?= $order['id'] ?></h3>
                                <p class="text-xs text-gray-400 mt-0.5"><?= date('d M Y, h:i A', strtotime($order['created_at'])) ?></p>
                            </div>
                        </div>
                        <div class="flex sm:flex-col sm:items-end gap-3 sm:gap-1">
                            <span class="px-3 py-1 rounded-full text-xs font-black uppercase <?= $statusColors[$order['status']] ?? 'text-gray-500 bg-gray-50' ?>">
                                <?= str_replace('_', ' ', $order['status']) ?>
                            </span>
                            <p class="text-lg sm:text-xl font-black text-brand-600">৳<?= number_format($order['total_price'], 0) ?></p>
                        </div>
                    </div>

                    <?php if (!$isCancelled): ?>
                    <!-- Progress Bar -->
                    <div class="mb-10 px-2 sm:px-4">
                        <div class="relative flex items-center justify-between">
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-gray-100 rounded-full"></div>
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-brand-500 rounded-full transition-all duration-1000"
                                 style="width: <?= (($currentStep - 1) / 4) * 100 ?>%"></div>
                            <?php
                            $stepLabels = [
                                ['label' => 'Pending',   'icon' => '⏳'],
                                ['label' => 'Accepted',  'icon' => '✅'],
                                ['label' => 'Preparing', 'icon' => '👨‍🍳'],
                                ['label' => 'On way',    'icon' => '🚴'],
                                ['label' => 'Delivered', 'icon' => '🏠'],
                            ];
                            foreach ($stepLabels as $index => $step):
                                $stepNum  = $index + 1;
                                $isActive = $stepNum <= $currentStep;
                            ?>
                                <div class="relative z-10 flex flex-col items-center">
                                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full flex items-center justify-center text-xs transition-all duration-300 <?= $isActive ? 'bg-brand-500 text-white shadow-lg' : 'bg-white border-2 border-gray-100 text-gray-300' ?>">
                                        <?= $isActive ? '✓' : $stepNum ?>
                                    </div>
                                    <div class="absolute top-9 whitespace-nowrap text-center">
                                        <p class="text-[9px] sm:text-[10px] font-bold uppercase tracking-tighter <?= $isActive ? 'text-brand-600' : 'text-gray-300' ?>">
                                            <?= $step['label'] ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mt-10 pt-5 border-t border-gray-50">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-brand-100 flex items-center justify-center text-sm font-bold text-brand-600 shrink-0">
                                <?= strtoupper(substr($order['chef_name'], 0, 1)) ?>
                            </div>
                            <div class="text-sm">
                                <p class="text-gray-400 font-medium text-xs">Prepared by</p>
                                <p class="font-bold text-gray-800">Chef <?= htmlspecialchars($order['chef_name']) ?></p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 flex-wrap">
                            <a href="<?= url('/order/track?id=' . $order['id']) ?>"
                                class="text-xs border border-brand-300 text-brand-600 hover:bg-brand-50 px-3 py-2 rounded-xl font-medium transition-colors">
                                📍 Track
                            </a>
                            <?php if ($order['status'] === 'delivered' && !Review::alreadyReviewed($order['id'])): ?>
                                <a href="<?= url('/review?order_id=' . $order['id']) ?>"
                                    class="text-xs bg-brand-500 hover:bg-brand-600 text-white px-3 py-2 rounded-xl font-medium transition-colors">
                                    ⭐ Review
                                </a>
                            <?php elseif ($order['status'] === 'delivered'): ?>
                                <span class="text-xs text-green-600 font-bold px-3 py-2 bg-green-50 rounded-xl">✅ Reviewed</span>
                            <?php endif; ?>
                            <div class="text-gray-400 text-xs flex items-center gap-1 max-w-[150px] sm:max-w-[200px]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
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
<?php
$title = 'Track Order | ChefNextDoor';
ob_start();

$steps = [
    'pending'          => 0,
    'accepted'         => 1,
    'preparing'        => 2,
    'out_for_delivery' => 3,
    'delivered'        => 4,
];
$currentStep = $steps[$order['status']] ?? 0;

$stepLabels = [
    'Order Placed',
    'Accepted',
    'Preparing',
    'Out for Delivery',
    'Delivered',
];

$stepIcons = ['📋', '✅', '👨‍🍳', '🚴', '🎉'];
?>
<div class="min-h-screen bg-brand-50">
    <nav class="bg-white border-b border-brand-100 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <img src="/ChefNextDoor/assets/images/chefnextdoor_logo.jpeg" alt="ChefNextDoor" class="w-8 h-8 object-contain" />
            <span class="text-lg font-bold text-brand-600">ChefNextDoor</span>
        </div>
        <div class="flex items-center gap-3">
            <a href="<?= url('/orders/history') ?>" class="text-sm text-gray-500 hover:text-brand-600">← My Orders</a>
            <a href="<?= url('/logout') ?>" class="text-sm bg-brand-500 hover:bg-brand-600 text-white px-4 py-2 rounded-xl font-medium transition-colors">Logout</a>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-6 py-10">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">📍 Order Tracking</h1>
        <p class="text-sm text-gray-400 mb-8">Order #<?= $order['id'] ?> — <?= htmlspecialchars($order['chef_name']) ?>'s Kitchen</p>

        <!-- Status pipeline -->
        <div class="bg-white rounded-2xl border border-brand-100 p-6 mb-6">
            <div class="relative">
                <!-- Progress bar -->
                <div class="absolute top-8 left-0 right-0 h-1 bg-gray-100 mx-8">
                    <div class="h-full bg-brand-500 transition-all duration-500"
                         style="width: <?= ($currentStep / 4) * 100 ?>%"></div>
                </div>

                <!-- Steps -->
                <div class="relative flex justify-between">
                    <?php foreach ($stepLabels as $i => $label): ?>
                        <div class="flex flex-col items-center gap-2 z-10">
                            <div class="w-16 h-16 rounded-full flex items-center justify-center text-2xl border-4
                                <?= $i <= $currentStep
                                    ? 'bg-brand-500 border-brand-500 text-white'
                                    : 'bg-white border-gray-200 text-gray-300' ?>
                                transition-all duration-300">
                                <?= $stepIcons[$i] ?>
                            </div>
                            <span class="text-xs font-medium text-center
                                <?= $i <= $currentStep ? 'text-brand-600' : 'text-gray-300' ?>
                                max-w-[60px] leading-tight">
                                <?= $label ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Current status message -->
            <div class="mt-8 text-center">
                <?php
                $messages = [
                    'pending'          => 'Your order is waiting for the chef to accept it.',
                    'accepted'         => 'Great! The chef has accepted your order.',
                    'preparing'        => 'Your food is being prepared with love! 👨‍🍳',
                    'out_for_delivery' => 'Your food is on the way! 🚴',
                    'delivered'        => 'Your order has been delivered. Enjoy your meal! 🎉',
                    'cancelled'        => 'This order was cancelled.',
                ];
                ?>
                <p class="text-sm font-medium text-brand-600 bg-brand-50 px-4 py-2 rounded-xl inline-block">
                    <?= $messages[$order['status']] ?? 'Order status unknown.' ?>
                </p>
            </div>
        </div>

        <!-- Order details -->
        <div class="bg-white rounded-2xl border border-brand-100 p-5 mb-4">
            <h2 class="font-semibold text-gray-700 mb-3">Order Details</h2>
            <div class="space-y-2">
                <?php foreach ($items as $item): ?>
                    <div class="flex items-center gap-3">
                        <?php if ($item['image']): ?>
                            <img src="/ChefNextDoor/uploads/dishes/<?= htmlspecialchars($item['image']) ?>"
                                 class="w-10 h-10 rounded-lg object-cover" />
                        <?php else: ?>
                            <div class="w-10 h-10 rounded-lg bg-brand-50 flex items-center justify-center text-lg">🍽️</div>
                        <?php endif; ?>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800"><?= htmlspecialchars($item['title']) ?></p>
                            <p class="text-xs text-gray-400">× <?= $item['quantity'] ?></p>
                        </div>
                        <p class="text-sm font-bold text-brand-600">৳<?= number_format($item['subtotal'], 0) ?></p>
                    </div>
                <?php endforeach; ?>
                <div class="border-t border-gray-50 pt-3 flex justify-between font-bold text-gray-800">
                    <span>Total</span>
                    <span class="text-brand-600">৳<?= number_format($order['total_price'], 0) ?></span>
                </div>
            </div>
        </div>

        <!-- Delivery address -->
        <div class="bg-white rounded-2xl border border-brand-100 p-5">
            <h2 class="font-semibold text-gray-700 mb-2">Delivery Address</h2>
            <p class="text-sm text-gray-500">📍 <?= htmlspecialchars($order['delivery_address']) ?></p>
            <p class="text-xs text-gray-300 mt-2">Ordered on <?= date('d M Y, h:i A', strtotime($order['created_at'])) ?></p>
        </div>

        <?php if ($order['status'] === 'delivered' && !\App\Models\Review::alreadyReviewed($order['id'])): ?>
            <a href="<?= url('/review?order_id=' . $order['id']) ?>"
                class="block w-full text-center mt-4 bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-3 rounded-xl transition-colors">
                ⭐ Leave a Review
            </a>
        <?php endif; ?>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
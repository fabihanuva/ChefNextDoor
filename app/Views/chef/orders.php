<?php
use App\Core\Session;
$title = 'Manage Orders | ChefNextDoor';
ob_start();
?>
<div class="min-h-screen bg-brand-50">
    <nav class="bg-white border-b border-orange-100 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-2xl">🍳</span>
            <span class="text-lg font-bold text-brand-600">ChefNextDoor</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="<?= url('/chef-dashboard') ?>" class="text-sm text-gray-500 hover:text-brand-600">← Dashboard</a>
            <a href="<?= url('/logout') ?>" class="text-sm bg-brand-500 hover:bg-brand-600 text-white px-4 py-2 rounded-xl font-medium transition-colors">Logout</a>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-6 py-10">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">📦 Manage Orders</h1>

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

        <?php if (empty($orders)): ?>
            <div class="bg-white rounded-2xl border border-orange-100 p-12 text-center">
                <div class="text-5xl mb-4">📦</div>
                <h2 class="text-lg font-semibold text-gray-700">No orders yet</h2>
                <p class="text-sm text-gray-400 mt-1">Orders from customers will appear here</p>
            </div>
        <?php else: ?>
            <div class="space-y-4">
                <?php foreach ($orders as $order):
                    $statusColors = [
                        'pending'          => 'bg-yellow-50 text-yellow-600 border-yellow-200',
                        'accepted'         => 'bg-blue-50 text-blue-600 border-blue-200',
                        'preparing'        => 'bg-purple-50 text-purple-600 border-purple-200',
                        'out_for_delivery' => 'bg-orange-50 text-orange-600 border-orange-200',
                        'delivered'        => 'bg-green-50 text-green-600 border-green-200',
                        'cancelled'        => 'bg-red-50 text-red-500 border-red-200',
                    ];
                    $statusColor = $statusColors[$order['status']] ?? 'bg-gray-50 text-gray-500';

                    $nextStatus = [
                        'pending'          => 'accepted',
                        'accepted'         => 'preparing',
                        'preparing'        => 'out_for_delivery',
                        'out_for_delivery' => 'delivered',
                    ];
                    $next = $nextStatus[$order['status']] ?? null;
                    $nextLabels = [
                        'accepted'         => '✅ Accept Order',
                        'preparing'        => '👨‍🍳 Mark Preparing',
                        'out_for_delivery' => '🚴 Mark Out for Delivery',
                        'delivered'        => '✅ Mark Delivered',
                    ];
                ?>
                    <div class="bg-white rounded-2xl border border-orange-100 p-5">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <p class="font-semibold text-gray-800">Order #<?= $order['id'] ?></p>
                                <p class="text-xs text-gray-400 mt-0.5">👤 <?= htmlspecialchars($order['customer_name']) ?></p>
                                <p class="text-xs text-gray-400">📅 <?= date('d M Y, h:i A', strtotime($order['created_at'])) ?></p>
                                <p class="text-xs text-gray-400 mt-1">📍 <?= htmlspecialchars($order['delivery_address']) ?></p>
                            </div>
                            <div class="text-right">
                                <span class="text-xs px-3 py-1 rounded-full font-medium border <?= $statusColor ?>">
                                    <?= ucfirst(str_replace('_', ' ', $order['status'])) ?>
                                </span>
                                <p class="font-bold text-brand-600 mt-2">৳<?= number_format($order['total_price'], 2) ?></p>
                            </div>
                        </div>

                        <!-- Action buttons -->
                        <?php if ($order['status'] !== 'delivered' && $order['status'] !== 'cancelled'): ?>
                            <div class="border-t border-gray-50 pt-3 flex gap-2 flex-wrap">
                                <?php if ($next): ?>
                                    <form method="POST" action="<?= url('/chef/orders/update') ?>">
                                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>" />
                                        <input type="hidden" name="status" value="<?= $next ?>" />
                                        <button type="submit"
                                            class="text-sm bg-brand-500 hover:bg-brand-600 text-white px-4 py-2 rounded-xl font-medium transition-colors">
                                            <?= $nextLabels[$next] ?>
                                        </button>
                                    </form>
                                <?php endif; ?>

                                <?php if ($order['status'] === 'pending'): ?>
                                    <form method="POST" action="<?= url('/chef/orders/update') ?>"
                                        onsubmit="return confirm('Cancel this order?')">
                                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>" />
                                        <input type="hidden" name="status" value="cancelled" />
                                        <button type="submit"
                                            class="text-sm border border-red-200 text-red-500 hover:bg-red-50 px-4 py-2 rounded-xl font-medium transition-colors">
                                            ❌ Cancel Order
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
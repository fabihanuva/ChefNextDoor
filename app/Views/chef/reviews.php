<?php
$title = 'My Reviews | ChefNextDoor';
ob_start();
?>
<div class="min-h-screen bg-brand-50">
    <?php include __DIR__ . '/../partials/navbar.php'; ?>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 py-8 sm:py-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">⭐ My Reviews</h1>
            <?php if (!empty($reviews)): ?>
                <div class="bg-white border border-brand-100 rounded-xl px-4 py-2 text-center">
                    <p class="text-2xl font-bold text-brand-500"><?= $avgRating ?></p>
                    <p class="text-xs text-gray-400">Avg Rating</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if (empty($reviews)): ?>
            <div class="bg-white rounded-2xl border border-brand-100 p-12 text-center">
                <div class="text-5xl mb-4">⭐</div>
                <h2 class="text-lg font-semibold text-gray-700">No reviews yet</h2>
                <p class="text-sm text-gray-400 mt-1">Complete orders to start receiving reviews!</p>
            </div>
        <?php else: ?>
            <div class="space-y-4">
                <?php foreach ($reviews as $review): ?>
                    <div class="bg-white rounded-2xl border border-brand-100 p-5">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="font-semibold text-gray-800"><?= e($review['customer_name']) ?></p>
                                <p class="text-xs text-gray-400 mt-0.5"><?= date('d M Y', strtotime($review['created_at'])) ?></p>
                            </div>
                            <span class="text-lg"><?= str_repeat('⭐', $review['rating']) ?></span>
                        </div>
                        <?php if ($review['comment']): ?>
                            <p class="text-sm text-gray-600 mt-2">"<?= e($review['comment']) ?>"</p>
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
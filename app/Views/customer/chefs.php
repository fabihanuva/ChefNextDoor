<?php
use App\Core\Session;
$title = 'Browse Chefs | ChefNextDoor';
ob_start();
?>
<div class="min-h-screen bg-brand-50">

    <?php include __DIR__ . '/../partials/navbar.php'; ?>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 py-8 sm:py-10">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800 mb-1">👨‍🍳 Choose a Chef</h1>
        <p class="text-sm text-gray-400 mb-6">Pick a home chef and explore their menu</p>

        <?php if (empty($chefs)): ?>
            <div class="bg-white rounded-2xl border border-brand-100 p-12 text-center">
                <div class="text-5xl mb-4">👨‍🍳</div>
                <h2 class="text-lg font-semibold text-gray-700">No chefs available yet</h2>
                <p class="text-sm text-gray-400 mt-1">Check back soon!</p>
            </div>
        <?php else: ?>
            <div class="space-y-3">
                <?php foreach ($chefs as $chef): ?>
                    <a href="<?= url('/chef-menu?id=' . $chef['id']) ?>"
                       class="bg-white rounded-2xl border border-brand-100 p-4 sm:p-5 flex items-center gap-3 sm:gap-4 hover:border-brand-400 hover:shadow-sm transition-all group">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-brand-100 flex items-center justify-center text-xl sm:text-2xl font-bold text-brand-600 shrink-0">
                            <?= strtoupper(substr($chef['name'], 0, 1)) ?>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-gray-800 group-hover:text-brand-600 truncate"><?= htmlspecialchars($chef['name']) ?></h3>
                            <?php if ($chef['specialty']): ?>
                                <p class="text-xs text-brand-600 font-medium mt-0.5 truncate"><?= htmlspecialchars($chef['specialty']) ?></p>
                            <?php endif; ?>
                            <?php if ($chef['bio']): ?>
                                <p class="text-xs text-gray-400 mt-1 line-clamp-1 hidden sm:block"><?= htmlspecialchars($chef['bio']) ?></p>
                            <?php endif; ?>
                            <?php if ($chef['location']): ?>
                                <p class="text-xs text-gray-400 mt-0.5">📍 <?= htmlspecialchars($chef['location']) ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="text-right shrink-0">
                            <?php if ($chef['avg_rating'] > 0): ?>
                                <p class="text-sm font-bold text-yellow-500">⭐ <?= number_format($chef['avg_rating'], 1) ?></p>
                                <p class="text-xs text-gray-400"><?= $chef['review_count'] ?> reviews</p>
                            <?php else: ?>
                                <p class="text-xs text-gray-300">New</p>
                            <?php endif; ?>
                            <span class="text-brand-400 text-lg mt-1 block">→</span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <?php if (isset($totalPages) && $totalPages > 1): ?>
                <div class="mt-8 flex justify-center items-center gap-2 flex-wrap">
                    <?php if ($currentPage > 1): ?>
                        <a href="<?= url('/chefs?page=' . ($currentPage - 1)) ?>"
                           class="w-10 h-10 rounded-xl bg-white border border-brand-100 flex items-center justify-center text-gray-500 hover:text-brand-600 transition-colors">←</a>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="<?= url('/chefs?page=' . $i) ?>"
                           class="w-10 h-10 rounded-xl flex items-center justify-center text-sm font-bold transition-all <?= $i === $currentPage ? 'bg-brand-500 text-white' : 'bg-white border border-brand-100 text-gray-500 hover:text-brand-600' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="<?= url('/chefs?page=' . ($currentPage + 1)) ?>"
                           class="w-10 h-10 rounded-xl bg-white border border-brand-100 flex items-center justify-center text-gray-500 hover:text-brand-600 transition-colors">→</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
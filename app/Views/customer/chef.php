<?php
use App\Core\Session;
use App\Models\Favorite;
$title = 'Chef ' . htmlspecialchars($profile['name']) . ' | ChefNextDoor';
ob_start();
?>
<div class="max-w-7xl mx-auto px-6 py-12">
    <!-- Chef Header Section -->
    <div class="card-base p-10 mb-12 relative overflow-hidden bg-white">
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-brand-500 to-orange-400"></div>
        
        <div class="flex flex-col md:flex-row items-center md:items-start gap-10">
            <!-- Avatar -->
            <div class="relative shrink-0">
                <div class="w-32 h-32 rounded-3xl bg-gradient-to-br from-brand-500 to-orange-400 flex items-center justify-center text-5xl font-bold text-white shadow-2xl shadow-brand-100 ring-4 ring-brand-50">
                    <?= strtoupper(substr($profile['name'], 0, 1)) ?>
                </div>
                <div class="absolute -bottom-2 -right-2 bg-green-500 border-4 border-white w-8 h-8 rounded-full flex items-center justify-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M20 6 9 17 4 12"/></svg>
                </div>
            </div>

            <div class="flex-grow text-center md:text-left">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
                    <div>
                        <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-1"><?= htmlspecialchars($profile['name']) ?></h1>
                        <p class="text-brand-600 font-bold uppercase tracking-[0.2em] text-xs"><?= htmlspecialchars($profile['specialty'] ?? 'Home Chef Extraordinaire') ?></p>
                    </div>
                    <div class="flex items-center justify-center md:justify-end gap-3">
                        <div class="px-4 py-2 rounded-xl bg-slate-50 border border-slate-100 flex items-center gap-2">
                            <span class="text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            </span>
                            <span class="text-slate-700 font-bold">4.9</span>
                            <span class="text-slate-400 text-xs font-medium">(120+ reviews)</span>
                        </div>
                    </div>
                </div>

                <p class="text-slate-600 max-w-2xl mb-6 leading-relaxed">
                    <?= nl2br(htmlspecialchars($profile['bio'] ?? 'This chef hasn\'t shared their story yet, but their food speaks for itself!')) ?>
                </p>

                <div class="flex flex-wrap items-center justify-center md:justify-start gap-6 text-sm">
                    <div class="flex items-center gap-2 text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand-500"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span class="font-medium"><?= htmlspecialchars($profile['location'] ?? 'Available for delivery') ?></span>
                    </div>
                    <div class="flex items-center gap-2 text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand-500"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                        <span class="font-medium"><?= count($dishes) ?> Dishes available</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chef's Menu -->
    <div class="mb-10 flex items-center justify-between">
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Chef's Special Menu</h2>
        <div class="h-px bg-slate-100 flex-grow mx-8 hidden md:block"></div>
    </div>

    <?php if (empty($dishes)): ?>
        <div class="card-base p-20 text-center">
            <div class="w-24 h-24 bg-brand-50 rounded-full flex items-center justify-center text-5xl mx-auto mb-6">🍳</div>
            <h2 class="text-2xl font-bold text-slate-800 mb-2">No active dishes</h2>
            <p class="text-slate-500 max-w-sm mx-auto">This chef currently doesn't have any dishes available for ordering. Check back later!</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <?php foreach ($dishes as $d): ?>
                <?php if (!$d['availability']) continue; ?>
                <div class="card-base overflow-hidden flex flex-col group">
                    <!-- Image Section -->
                    <div class="relative h-48 overflow-hidden">
                        <?php if ($d['image']): ?>
                            <img src="/ChefNextDoor/uploads/dishes/<?= htmlspecialchars($d['image']) ?>"
                                 alt="<?= htmlspecialchars($d['title']) ?>"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                        <?php else: ?>
                            <div class="w-full h-full bg-slate-100 flex items-center justify-center text-5xl">🍲</div>
                        <?php endif; ?>
                        
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 rounded-full bg-white/90 backdrop-blur-sm text-brand-600 text-[10px] font-bold uppercase tracking-wider shadow-sm">
                                <?= htmlspecialchars($d['category'] ?? 'General') ?>
                            </span>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-5 flex-grow flex flex-col">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="font-bold text-slate-800 text-lg leading-snug group-hover:text-brand-600 transition-colors">
                                <?= htmlspecialchars($d['title']) ?>
                            </h3>
                            <span class="text-xl font-black text-brand-600">৳<?= number_format($d['price'], 0) ?></span>
                        </div>

                        <p class="text-sm text-slate-500 line-clamp-2 mb-6 leading-relaxed flex-grow">
                            <?= htmlspecialchars($d['description'] ?? 'No description provided.') ?>
                        </p>

                        <div class="mt-auto flex items-center gap-3">
                            <form method="POST" action="<?= url('/cart/add') ?>" class="flex-grow">
                                <input type="hidden" name="dish_id" value="<?= $d['id'] ?>" />
                                <button type="submit" class="w-full btn-primary !py-2.5 !text-sm flex items-center justify-center gap-2 group/btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover/btn:translate-x-1 transition-transform"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                                    Add to Cart
                                </button>
                            </form>
                            <form method="POST" action="<?= url('/favorite/toggle') ?>">
                                <input type="hidden" name="dish_id" value="<?= $d['id'] ?>" />
                                <button type="submit" class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center hover:bg-red-50 hover:text-red-500 transition-all active:scale-95">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="<?= Favorite::isFavorited($user['id'], $d['id']) ? 'currentColor' : 'none' ?>" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                                </button>
                            </form>
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

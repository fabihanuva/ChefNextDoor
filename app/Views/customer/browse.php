<?php
use App\Core\Session;
use App\Models\Favorite;
$title = 'Browse Dishes | ChefNextDoor';
ob_start();
?>
<div class="max-w-7xl mx-auto px-6 py-12">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 border-b border-gray-100 pb-8">
        <div>
            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-2">🍽️ Discover Home Cooking</h1>
            <p class="text-lg text-slate-500">Freshly prepared meals from passionate local chefs in your neighborhood.</p>
        </div>
        <div class="flex items-center gap-3">
            <form action="<?= url('/browse') ?>" method="GET" class="relative">
                <input type="text" name="s" value="<?= e($search ?? '') ?>" placeholder="Search for dishes..." 
                    class="pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-brand-400 focus:border-transparent outline-none text-sm w-64 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                <?php if ($currentCategory ?? 'All' !== 'All'): ?>
                    <input type="hidden" name="category" value="<?= e($currentCategory) ?>">
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Category Filter -->
    <div class="flex items-center gap-2 mb-8 overflow-x-auto pb-2 scrollbar-hide">
        <?php 
        $categories = ['All', 'Rice', 'Curry', 'Soup', 'Salad', 'Dessert', 'Snacks', 'Drinks', 'Other'];
        $currCat = $currentCategory ?? 'All';
        foreach ($categories as $cat): 
            $isActive = ($currCat === $cat);
            $query = [];
            if ($cat !== 'All') $query['category'] = $cat;
            if (!empty($search)) $query['s'] = $search;
            $link = url('/browse') . (empty($query) ? '' : '?' . http_build_query($query));
        ?>
            <a href="<?= $link ?>" class="px-5 py-2 rounded-full text-sm font-bold transition-all whitespace-nowrap <?= $isActive ? 'bg-brand-500 text-white shadow-lg shadow-brand-100' : 'bg-white text-slate-500 hover:bg-brand-50 hover:text-brand-600' ?>">
                <?= $cat ?>
            </a>
        <?php endforeach; ?>
    </div>

    <?php if (empty($dishes)): ?>
        <div class="card-base p-20 text-center">
            <div class="w-24 h-24 bg-brand-50 rounded-full flex items-center justify-center text-5xl mx-auto mb-6">🔍</div>
            <h2 class="text-2xl font-bold text-slate-800 mb-2">No results found</h2>
            <p class="text-slate-500 max-w-sm mx-auto mb-8">We couldn't find any dishes matching your criteria. Try adjusting your search or filters.</p>
            <a href="<?= url('/browse') ?>" class="btn-primary">Clear all filters</a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <?php foreach ($dishes as $d): ?>
                <div class="card-base overflow-hidden flex flex-col group">
                    <!-- Image Section -->
                    <div class="relative h-56 overflow-hidden">
                        <?php if ($d['image']): ?>
                            <img src="/ChefNextDoor/uploads/dishes/<?= e($d['image']) ?>"
                                 alt="<?= e($d['title']) ?>"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                        <?php else: ?>
                            <div class="w-full h-full bg-slate-100 flex items-center justify-center text-6xl">🍲</div>
                        <?php endif; ?>
                        
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 rounded-full bg-white/90 backdrop-blur-sm text-brand-600 text-[10px] font-bold uppercase tracking-wider shadow-sm">
                                <?= e($d['category'] ?? 'General') ?>
                            </span>
                        </div>
                        
                        <div class="absolute top-4 right-4">
                            <form method="POST" action="<?= url('/favorite/toggle') ?>">
                                <?= csrf_field() ?>
                                <input type="hidden" name="dish_id" value="<?= $d['id'] ?>" />
                                <button type="submit" class="w-10 h-10 rounded-full bg-white/90 backdrop-blur-sm flex items-center justify-center shadow-lg hover:scale-110 transition-transform active:scale-95">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="<?= Favorite::isFavorited($user['id'], $d['id']) ? '#ef4444' : 'none' ?>" stroke="<?= Favorite::isFavorited($user['id'], $d['id']) ? '#ef4444' : '#64748b' ?>" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-colors"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-5 flex-grow flex flex-col">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="font-bold text-slate-800 text-lg leading-snug group-hover:text-brand-600 transition-colors">
                                <?= e($d['title']) ?>
                            </h3>
                            <span class="text-xl font-black text-brand-600">৳<?= number_format($d['price'], 0) ?></span>
                        </div>
                        
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-[10px] font-bold text-slate-600">
                                <?= strtoupper(substr($d['chef_name'], 0, 1)) ?>
                            </div>
                            <span class="text-xs font-medium text-slate-500">by 
                                <a href="<?= url('/chef/profile/public?id=' . $d['chef_id']) ?>" class="text-slate-800 font-bold hover:text-brand-600 transition-colors">
                                    <?= e($d['chef_name']) ?>
                                </a>
                            </span>
                        </div>

                        <p class="text-sm text-slate-500 line-clamp-2 mb-6 leading-relaxed">
                            <?= e($d['description'] ?? 'No description provided by the chef.') ?>
                        </p>

                        <div class="mt-auto pt-4">
                            <form method="POST" action="<?= url('/cart/add') ?>">
                                <?= csrf_field() ?>
                                <input type="hidden" name="dish_id" value="<?= $d['id'] ?>" />
                                <button type="submit" class="w-full btn-primary !py-2 !text-sm flex items-center justify-center gap-2 group/btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover/btn:translate-x-1 transition-transform"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                                    Add to Cart
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

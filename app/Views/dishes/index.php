<?php
use App\Core\Session;
$title = 'My Dishes | ChefNextDoor';
ob_start();
?>
<div class="max-w-6xl mx-auto px-6 py-12">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div class="flex items-center gap-4">
            <a href="<?= url('/chef-dashboard') ?>" class="p-2 rounded-full hover:bg-white transition-colors text-slate-400 hover:text-brand-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            </a>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">🍽️ My Dishes</h1>
        </div>
        <a href="<?= url('/dishes/create') ?>" class="btn-primary flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            Add New Dish
        </a>
    </div>

    <?php if (empty($dishes)): ?>
        <div class="card-base p-20 text-center">
            <div class="w-24 h-24 bg-brand-50 rounded-full flex items-center justify-center text-5xl mx-auto mb-6">🍳</div>
            <h2 class="text-2xl font-bold text-slate-800 mb-2">Your kitchen is empty</h2>
            <p class="text-slate-500 max-w-sm mx-auto mb-8">Start sharing your culinary talent with your neighbors by adding your first dish to the menu.</p>
            <a href="<?= url('/dishes/create') ?>" class="btn-primary">
                Create Your First Dish
            </a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($dishes as $d): ?>
                <div class="card-base overflow-hidden flex flex-col group">
                    <!-- Image Section -->
                    <div class="relative h-48 overflow-hidden">
                        <?php if ($d['image']): ?>
                            <img src="/ChefNextDoor/uploads/dishes/<?= e($d['image']) ?>"
                                 alt="<?= e($d['title']) ?>"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                        <?php else: ?>
                            <div class="w-full h-full bg-slate-100 flex items-center justify-center text-5xl">🍲</div>
                        <?php endif; ?>
                        
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-lg <?= $d['availability'] ? 'bg-green-500 text-white' : 'bg-slate-500 text-white' ?>">
                                <?= $d['availability'] ? 'Live' : 'Hidden' ?>
                            </span>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-6 flex-grow flex flex-col">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-bold text-slate-800 text-lg group-hover:text-brand-600 transition-colors">
                                <?= e($d['title']) ?>
                            </h3>
                            <span class="text-lg font-black text-brand-600">৳<?= number_format($d['price'], 0) ?></span>
                        </div>
                        
                        <p class="text-[10px] font-bold text-brand-600 uppercase tracking-widest mb-4">
                            <?= e($d['category'] ?? 'General') ?>
                        </p>

                        <p class="text-sm text-slate-500 line-clamp-2 mb-6 leading-relaxed flex-grow">
                            <?= e($d['description'] ?? 'No description provided.') ?>
                        </p>

                        <div class="flex items-center justify-between mb-6 pb-6 border-b border-gray-50">
                            <div class="flex flex-col">
                                <span class="text-[10px] text-slate-400 uppercase font-bold tracking-tighter">Stock Level</span>
                                <span class="text-sm font-bold <?= $d['stock'] < 5 ? 'text-red-500' : 'text-slate-700' ?>">
                                    <?= $d['stock'] ?> Portions left
                                </span>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <a href="<?= url('/dishes/edit?id=' . $d['id']) ?>"
                                class="flex-1 flex items-center justify-center gap-2 bg-slate-50 hover:bg-slate-100 text-slate-700 font-bold py-2.5 rounded-xl transition-all text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                Edit
                            </a>
                            <form method="POST" action="<?= url('/dishes/delete') ?>"
                                  onsubmit="return confirm('Are you sure you want to delete this dish?')">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id" value="<?= $d['id'] ?>">
                                <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 bg-red-50 hover:bg-red-100 text-red-600 font-bold py-2.5 rounded-xl transition-all text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                    Delete
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

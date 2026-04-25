<?php
use App\Core\Session;
$title = 'My Favourites | ChefNextDoor';
ob_start();
?>
<div class="min-h-screen bg-brand-50">
    <nav class="bg-white border-b border-orange-100 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-2xl">🍳</span>
            <span class="text-lg font-bold text-brand-600">ChefNextDoor</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="<?= url('/dashboard') ?>" class="text-sm text-gray-500 hover:text-brand-600">← Dashboard</a>
            <a href="<?= url('/logout') ?>" class="text-sm bg-brand-500 hover:bg-brand-600 text-white px-4 py-2 rounded-xl font-medium transition-colors">Logout</a>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-6 py-10">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">❤️ My Favourites</h1>

        <?php if (Session::get('success')): ?>
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                <?= htmlspecialchars(Session::get('success')) ?>
                <?php Session::remove('success'); ?>
            </div>
        <?php endif; ?>

        <?php if (empty($dishes)): ?>
            <div class="bg-white rounded-2xl border border-orange-100 p-12 text-center">
                <div class="text-5xl mb-4">❤️</div>
                <h2 class="text-lg font-semibold text-gray-700">No favourites yet</h2>
                <p class="text-sm text-gray-400 mt-1 mb-5">Browse dishes and heart the ones you love!</p>
                <a href="<?= url('/browse') ?>"
                    class="bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">
                    Browse Dishes
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <?php foreach ($dishes as $d): ?>
                    <div class="bg-white rounded-2xl border border-orange-100 overflow-hidden hover:border-brand-300 transition-colors">
                        <?php if ($d['image']): ?>
                            <img src="/ChefNextDoor/uploads/dishes/<?= htmlspecialchars($d['image']) ?>"
                                 alt="<?= htmlspecialchars($d['title']) ?>"
                                 class="w-full h-44 object-cover" />
                        <?php else: ?>
                            <div class="w-full h-44 bg-brand-50 flex items-center justify-center text-5xl">🍽️</div>
                        <?php endif; ?>

                        <div class="p-4">
                            <div class="flex items-start justify-between mb-1">
                                <h3 class="font-semibold text-gray-800"><?= htmlspecialchars($d['title']) ?></h3>
                                <span class="text-brand-600 font-bold text-sm ml-2">৳<?= number_format($d['price'], 2) ?></span>
                            </div>
                            <p class="text-xs text-gray-400 mb-3">👨‍🍳 <?= htmlspecialchars($d['chef_name']) ?></p>

                            <div class="flex gap-2">
                                <form method="POST" action="<?= url('/cart/add') ?>" class="flex-1">
                                    <input type="hidden" name="dish_id" value="<?= $d['id'] ?>" />
                                    <button type="submit"
                                        class="w-full text-xs bg-brand-500 hover:bg-brand-600 text-white px-3 py-2 rounded-xl font-medium transition-colors">
                                        + Add to Cart
                                    </button>
                                </form>
                                <form method="POST" action="<?= url('/favorite/toggle') ?>">
                                    <input type="hidden" name="dish_id" value="<?= $d['id'] ?>" />
                                    <button type="submit"
                                        class="text-xs border border-red-200 text-red-400 hover:bg-red-50 px-3 py-2 rounded-xl transition-colors">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
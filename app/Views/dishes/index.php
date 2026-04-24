<?php
use App\Core\Session;
$title = 'My Dishes | ChefNextDoor';
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

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">🍽️ My Dishes</h1>
            <a href="<?= url('/dishes/create') ?>"
                class="bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-colors">
                + Add New Dish
            </a>
        </div>

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

        <?php if (empty($dishes)): ?>
            <div class="bg-white rounded-2xl border border-orange-100 p-12 text-center">
                <div class="text-5xl mb-4">🍽️</div>
                <h2 class="text-lg font-semibold text-gray-700">No dishes yet</h2>
                <p class="text-sm text-gray-400 mt-1 mb-5">Start by adding your first home-cooked dish!</p>
                <a href="<?= url('/dishes/create') ?>"
                    class="bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">
                    + Add First Dish
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <?php foreach ($dishes as $d): ?>
                    <div class="bg-white rounded-2xl border border-orange-100 overflow-hidden">
                        <?php if ($d['image']): ?>
                            <img src="/ChefNextDoor/uploads/dishes/<?= htmlspecialchars($d['image']) ?>"
                                 alt="<?= htmlspecialchars($d['title']) ?>"
                                 class="w-full h-40 object-cover" />
                        <?php else: ?>
                            <div class="w-full h-40 bg-brand-50 flex items-center justify-center text-5xl">🍽️</div>
                        <?php endif; ?>

                        <div class="p-4">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="font-semibold text-gray-800"><?= htmlspecialchars($d['title']) ?></h3>
                                    <p class="text-xs text-gray-400 mt-0.5"><?= htmlspecialchars($d['category'] ?? 'Uncategorized') ?></p>
                                </div>
                                <span class="text-brand-600 font-bold text-sm">৳<?= number_format($d['price'], 2) ?></span>
                            </div>
                            <p class="text-xs text-gray-500 mt-2 line-clamp-2"><?= htmlspecialchars($d['description'] ?? '') ?></p>

                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-xs px-2 py-0.5 rounded-full <?= $d['availability'] ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-500' ?>">
                                    <?= $d['availability'] ? 'Available' : 'Unavailable' ?>
                                </span>
                                <span class="text-xs text-gray-400">Stock: <?= $d['stock'] ?></span>
                            </div>

                            <div class="flex gap-2 mt-4">
                                <a href="<?= url('/dishes/edit?id=' . $d['id']) ?>"
                                    class="flex-1 text-center text-sm border border-brand-400 text-brand-600 hover:bg-brand-50 py-1.5 rounded-xl transition-colors">
                                    ✏️ Edit
                                </a>
                                <form method="POST" action="<?= url('/dishes/delete') ?>"
                                    onsubmit="return confirm('Delete this dish?')" class="flex-1">
                                    <input type="hidden" name="id" value="<?= $d['id'] ?>" />
                                    <button type="submit"
                                        class="w-full text-sm border border-red-200 text-red-500 hover:bg-red-50 py-1.5 rounded-xl transition-colors">
                                        🗑️ Delete
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
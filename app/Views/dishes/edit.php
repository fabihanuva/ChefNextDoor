<?php
use App\Core\Session;
$title = 'Edit Dish | ChefNextDoor';
ob_start();
?>
<div class="min-h-screen bg-brand-50">
    <nav class="bg-white border-b border-orange-100 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-2xl">🍳</span>
            <span class="text-lg font-bold text-brand-600">ChefNextDoor</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="<?= url('/dishes') ?>" class="text-sm text-gray-500 hover:text-brand-600">← My Dishes</a>
            <a href="<?= url('/logout') ?>" class="text-sm bg-brand-500 hover:bg-brand-600 text-white px-4 py-2 rounded-xl font-medium transition-colors">Logout</a>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-6 py-10">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">✏️ Edit Dish</h1>

        <?php if (Session::get('error')): ?>
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                <?= htmlspecialchars(Session::get('error')) ?>
                <?php Session::remove('error'); ?>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-2xl border border-orange-100 p-8">
            <form method="POST" action="<?= url('/dishes/update') ?>" enctype="multipart/form-data" class="space-y-5">
                <input type="hidden" name="id" value="<?= $dish['id'] ?>" />

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dish Title *</label>
                    <input type="text" name="title" required value="<?= htmlspecialchars($dish['title']) ?>"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="3"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm resize-none"><?= htmlspecialchars($dish['description'] ?? '') ?></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price (৳) *</label>
                        <input type="number" name="price" required min="0" step="0.01"
                            value="<?= $dish['price'] ?>"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stock (portions)</label>
                        <input type="number" name="stock" min="0"
                            value="<?= $dish['stock'] ?>"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm">
                        <?php foreach (['Rice','Curry','Soup','Salad','Dessert','Snacks','Drinks','Other'] as $cat): ?>
                            <option value="<?= $cat ?>" <?= $dish['category'] === $cat ? 'selected' : '' ?>><?= $cat ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dish Image</label>
                    <?php if ($dish['image']): ?>
                        <img src="/ChefNextDoor/uploads/dishes/<?= htmlspecialchars($dish['image']) ?>"
                             class="w-24 h-24 object-cover rounded-xl mb-2" />
                        <p class="text-xs text-gray-400 mb-1">Upload a new image to replace the current one.</p>
                    <?php endif; ?>
                    <input type="file" name="image" accept="image/*"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-gray-500 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-brand-50 file:text-brand-600 file:text-sm" />
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="availability" id="availability" value="1"
                        <?= $dish['availability'] ? 'checked' : '' ?>
                        class="w-4 h-4 accent-brand-500" />
                    <label for="availability" class="text-sm text-gray-700">Available for ordering</label>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 bg-brand-500 hover:bg-brand-600 text-white font-semibold py-2.5 rounded-xl transition-colors text-sm">
                        Save Changes
                    </button>
                    <a href="<?= url('/dishes') ?>"
                        class="flex-1 text-center border border-gray-200 hover:bg-gray-50 text-gray-600 font-semibold py-2.5 rounded-xl transition-colors text-sm">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
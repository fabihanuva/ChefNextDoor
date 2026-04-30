<?php
use App\Core\Session;
$title = 'Edit Dish | ChefNextDoor';
ob_start();
?>

<?php include __DIR__ . '/../partials/navbar.php'; ?>

<div class="max-w-3xl mx-auto px-6 py-12">
    <div class="flex items-center gap-4 mb-10">
        <a href="<?= url('/dishes') ?>" class="p-2 rounded-full hover:bg-white transition-colors text-slate-400 hover:text-brand-600">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Edit Dish Details</h1>
    </div>

    <div class="card-base p-8 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-500 to-orange-400"></div>
        
        <form method="POST" action="<?= url('/dishes/update') ?>" enctype="multipart/form-data" class="space-y-8">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= $dish['id'] ?>">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Dish Title *</label>
                    <input type="text" name="title" required value="<?= htmlspecialchars($dish['title']) ?>"
                        class="input-base" />
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Detailed Description</label>
                    <textarea name="description" rows="4" class="input-base resize-none"><?= htmlspecialchars($dish['description'] ?? '') ?></textarea>
                </div>

                <!-- Price & Stock -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Price (৳) *</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-sm">৳</span>
                        <input type="number" name="price" required min="0" step="0.01" value="<?= $dish['price'] ?>"
                            class="input-base !pl-8" />
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Available Stock</label>
                    <input type="number" name="stock" min="0" value="<?= $dish['stock'] ?>"
                        class="input-base" />
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Category</label>
                    <select name="category" class="input-base appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2020%2020%22%3E%3Cpath%20stroke%3D%22%236b7280%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%221.5%22%20d%3D%22m6%208%204%204%204-4%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_0.5rem_center] bg-no-repeat">
                        <?php $cats = ['Rice', 'Curry', 'Soup', 'Salad', 'Dessert', 'Snacks', 'Drinks', 'Other']; ?>
                        <?php foreach ($cats as $cat): ?>
                            <option value="<?= $cat ?>" <?= ($dish['category'] ?? '') === $cat ? 'selected' : '' ?>><?= $cat ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Current Image Preview -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-4">Dish Image</label>
                    <div class="flex items-start gap-6">
                        <?php if ($dish['image']): ?>
                            <div class="relative group">
                                <img src="/ChefNextDoor/uploads/dishes/<?= htmlspecialchars($dish['image']) ?>" 
                                     class="w-32 h-32 rounded-2xl object-cover border-4 border-white shadow-lg" />
                                <div class="absolute inset-0 bg-black/40 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="text-[10px] text-white font-bold uppercase">Current</span>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="flex-grow">
                            <input type="file" name="image" accept="image/*"
                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 transition-all" />
                            <p class="text-xs text-slate-400 mt-2 italic">Leave empty to keep current image.</p>
                        </div>
                    </div>
                </div>

                <!-- Availability -->
                <div class="md:col-span-2">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative">
                            <input type="checkbox" name="availability" id="availability" value="1" <?= $dish['availability'] ? 'checked' : '' ?> class="sr-only peer" />
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-500"></div>
                        </div>
                        <span class="text-sm font-bold text-slate-700 group-hover:text-slate-900 transition-colors">Mark as available for ordering</span>
                    </label>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-50">
                <button type="submit" class="btn-primary !px-12">
                    Save Changes
                </button>
                <a href="<?= url('/dishes') ?>" class="flex items-center justify-center px-8 py-2.5 rounded-xl text-slate-500 font-bold hover:bg-slate-50 transition-all text-sm">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';

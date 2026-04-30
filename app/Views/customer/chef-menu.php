<?php
use App\Core\Session;

$chef   = $chef ?? null;
$cart   = $cart ?? [];
$dishes = $dishes ?? [];
$user   = $user ?? null;

if (!$chef) {
    echo "<p class='text-center mt-10 text-red-500'>Chef not found.</p>";
    return;
}

$title = htmlspecialchars($chef['name']) . "'s Kitchen | ChefNextDoor";
ob_start();
?>

<div class="min-h-screen bg-brand-50">

    <?php include __DIR__ . '/../partials/navbar.php'; ?>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 py-8 sm:py-10">

        <?php if (Session::get('success')): ?>
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                <?= htmlspecialchars(Session::get('success')) ?>
                <?php Session::remove('success'); ?>
            </div>
        <?php endif; ?>

        <!-- Chef Header -->
        <div class="bg-white rounded-2xl border border-brand-100 p-4 sm:p-6 mb-6">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-brand-100 flex items-center justify-center text-2xl sm:text-3xl font-bold text-brand-600 shrink-0">
                    <?= strtoupper(substr($chef['name'], 0, 1)) ?>
                </div>
                <div>
                    <h1 class="text-lg sm:text-xl font-bold text-gray-800">
                        <?= htmlspecialchars($chef['name']) ?>'s Kitchen
                    </h1>
                    <?php if (!empty($chef['specialty'])): ?>
                        <p class="text-sm text-brand-600"><?= htmlspecialchars($chef['specialty']) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($chef['avg_rating'])): ?>
                        <p class="text-sm text-yellow-500">
                            ⭐ <?= number_format($chef['avg_rating'], 1) ?>
                            (<?= $chef['review_count'] ?> reviews)
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <?php if (!empty($chef['bio'])): ?>
                <p class="text-sm text-gray-500"><?= htmlspecialchars($chef['bio']) ?></p>
            <?php endif; ?>
        </div>

        <!-- Search -->
        <div class="mb-5">
            <div class="relative">
                <input type="text" id="dishSearch"
                       placeholder="Search dishes..."
                       class="w-full px-4 py-3 pl-10 rounded-xl border border-brand-100 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm bg-white" />
                <span class="absolute left-3 top-3.5 text-gray-400">🔍</span>
            </div>
        </div>

        <!-- Dishes -->
        <div id="dishesContainer">
            <?php if (empty($dishes)): ?>
                <div class="bg-white rounded-2xl border border-brand-100 p-10 text-center">
                    <div class="text-5xl mb-4">🍽️</div>
                    <h2 class="text-lg font-semibold text-gray-700">No dishes available</h2>
                </div>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach ($dishes as $d): ?>
                        <?php $inCart = $cart[$d['id']]['quantity'] ?? 0; ?>
                        <div class="bg-white rounded-2xl border border-brand-100 overflow-hidden">
                            <?php if (!empty($d['image'])): ?>
                                <img src="/ChefNextDoor/uploads/dishes/<?= htmlspecialchars($d['image']) ?>"
                                     class="w-full h-40 sm:h-44 object-cover" />
                            <?php else: ?>
                                <div class="w-full h-40 sm:h-44 bg-brand-50 flex items-center justify-center text-5xl">🍽️</div>
                            <?php endif; ?>
                            <div class="p-4">
                                <div class="flex justify-between mb-1">
                                    <h3 class="font-semibold text-gray-800"><?= htmlspecialchars($d['title']) ?></h3>
                                    <span class="text-brand-600 font-bold ml-2">৳<?= number_format($d['price'], 0) ?></span>
                                </div>
                                <p class="text-xs text-gray-400 mb-3"><?= htmlspecialchars($d['description'] ?? '') ?></p>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs bg-brand-50 text-brand-600 px-2 py-1 rounded-lg">
                                        <?= htmlspecialchars($d['category'] ?? 'Other') ?>
                                    </span>
                                    <div class="flex items-center gap-3">
                                        <?php if ($inCart > 0): ?>
                                            <form method="POST" action="<?= url('/cart/update') ?>">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="dish_id" value="<?= $d['id'] ?>" />
                                                <input type="hidden" name="quantity" value="<?= $inCart - 1 ?>" />
                                                <button type="submit" class="w-8 h-8 bg-brand-500 hover:bg-brand-600 text-white rounded-full font-bold text-lg flex items-center justify-center transition-colors">−</button>
                                            </form>
                                            <span class="font-semibold text-gray-800 w-4 text-center"><?= $inCart ?></span>
                                        <?php else: ?>
                                            <span class="w-8 h-8"></span>
                                            <span class="font-semibold text-gray-300 w-4 text-center">0</span>
                                        <?php endif; ?>
                                        <form method="POST" action="<?= url('/cart/add') ?>">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="dish_id" value="<?= $d['id'] ?>" />
                                            <button type="submit" class="w-8 h-8 bg-brand-500 hover:bg-brand-600 text-white rounded-full font-bold text-lg flex items-center justify-center transition-colors">+</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Sticky cart button -->
                <?php $cartCount = array_sum(array_column($cart, 'quantity')); ?>
                <?php if ($cartCount > 0): ?>
                    <div class="mt-6 sticky bottom-4">
                        <a href="<?= url('/cart') ?>"
                           class="block text-center bg-brand-500 hover:bg-brand-600 text-white font-semibold py-3 rounded-xl transition-colors shadow-lg">
                            View Cart (<?= $cartCount ?> items) →
                        </a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
const dishSearch = document.getElementById('dishSearch');
const container  = document.getElementById('dishesContainer');
const chefId     = <?= (int)$chef['id'] ?>;
const baseUrl    = '<?= url('/api/dishes') ?>';
let timeout      = null;

dishSearch.addEventListener('input', function(e) {
    clearTimeout(timeout);
    const query = e.target.value.trim();
    timeout = setTimeout(() => fetchDishes(query), 300);
});

async function fetchDishes(query) {
    container.style.opacity = '0.5';
    try {
        const res  = await fetch(`${baseUrl}?chef_id=${chefId}&q=${encodeURIComponent(query)}`);
        const data = await res.json();
        container.style.opacity = '1';

        if (data.length === 0) {
            container.innerHTML = `
                <div class="bg-white rounded-2xl border border-brand-100 p-10 text-center">
                    <div class="text-5xl mb-4">🔍</div>
                    <h2 class="text-lg font-semibold text-gray-700">No dishes matched your search</h2>
                </div>`;
            return;
        }

        let html = '<div class="space-y-4">';
        data.forEach(d => {
            const img = d.image
                ? `<img src="/ChefNextDoor/uploads/dishes/${d.image}" class="w-full h-40 sm:h-44 object-cover" />`
                : `<div class="w-full h-40 sm:h-44 bg-brand-50 flex items-center justify-center text-5xl">🍽️</div>`;
            html += `
                <div class="bg-white rounded-2xl border border-brand-100 overflow-hidden">
                    ${img}
                    <div class="p-4">
                        <div class="flex justify-between mb-1">
                            <h3 class="font-semibold text-gray-800">${d.title}</h3>
                            <span class="text-brand-600 font-bold ml-2">৳${parseInt(d.price).toLocaleString()}</span>
                        </div>
                        <p class="text-xs text-gray-400 mb-3">${d.description || ''}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xs bg-brand-50 text-brand-600 px-2 py-1 rounded-lg">${d.category || 'Other'}</span>
                            <form method="POST" action="<?= url('/cart/add') ?>">
                                <?= csrf_field() ?>
                                <input type="hidden" name="dish_id" value="${d.id}" />
                                <button type="submit" class="w-8 h-8 bg-brand-500 hover:bg-brand-600 text-white rounded-full font-bold text-lg flex items-center justify-center transition-colors">+</button>
                            </form>
                        </div>
                    </div>
                </div>`;
        });
        html += '</div>';
        container.innerHTML = html;
    } catch (err) {
        container.style.opacity = '1';
        container.innerHTML = '<p class="text-center text-red-500 py-10">Failed to load dishes. Please refresh.</p>';
    }
}
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
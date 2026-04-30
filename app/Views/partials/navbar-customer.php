<?php use App\Core\Session; ?>
<nav class="bg-white border-b border-brand-100 px-4 py-3 sticky top-0 z-50">
    <div class="flex items-center justify-between">
        <!-- Logo -->
        <a href="<?= url('/dashboard') ?>" class="flex items-center gap-2">
            <img src="/ChefNextDoor/assets/images/chefnextdoor_logo.jpeg" alt="ChefNextDoor" class="w-8 h-8 object-contain" />
            <span class="text-base font-bold text-brand-600">ChefNextDoor</span>
        </a>

        <!-- Desktop nav -->
        <div class="hidden md:flex items-center gap-3">
            <?php $cartCount = array_sum(array_column(Session::get('cart') ?? [], 'quantity')); ?>
            <a href="<?= url('/cart') ?>" class="text-sm text-gray-500 hover:text-brand-600">
                🛒 Cart <?php if ($cartCount > 0): ?>
                    <span class="bg-brand-500 text-white text-xs px-1.5 py-0.5 rounded-full"><?= $cartCount ?></span>
                <?php endif; ?>
            </a>
            <a href="<?= url('/chefs') ?>" class="text-sm text-gray-500 hover:text-brand-600">Browse</a>
            <a href="<?= url('/orders/history') ?>" class="text-sm text-gray-500 hover:text-brand-600">Orders</a>
            <a href="<?= url('/profile') ?>" class="text-sm text-gray-500 hover:text-brand-600">Profile</a>
            <a href="<?= url('/logout') ?>" class="text-sm bg-brand-500 hover:bg-brand-600 text-white px-4 py-2 rounded-xl font-medium transition-colors">Logout</a>
        </div>

        <!-- Mobile hamburger -->
        <button id="menuBtn" class="md:hidden p-2 rounded-xl hover:bg-brand-50 transition-colors">
            <svg id="menuIcon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
    </div>

    <!-- Mobile menu -->
    <div id="mobileMenu" class="hidden md:hidden mt-3 pb-2 border-t border-brand-50 pt-3 space-y-1">
        <?php $cartCount = array_sum(array_column(Session::get('cart') ?? [], 'quantity')); ?>
        <a href="<?= url('/dashboard') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-brand-50 text-sm text-gray-700 font-medium">🏠 Dashboard</a>
        <a href="<?= url('/chefs') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-brand-50 text-sm text-gray-700 font-medium">👨‍🍳 Browse Chefs</a>
        <a href="<?= url('/cart') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-brand-50 text-sm text-gray-700 font-medium">
            🛒 Cart
            <?php if ($cartCount > 0): ?>
                <span class="bg-brand-500 text-white text-xs px-1.5 py-0.5 rounded-full"><?= $cartCount ?></span>
            <?php endif; ?>
        </a>
        <a href="<?= url('/orders/history') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-brand-50 text-sm text-gray-700 font-medium">📦 My Orders</a>
        <a href="<?= url('/favorites') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-brand-50 text-sm text-gray-700 font-medium">❤️ Favourites</a>
        <a href="<?= url('/profile') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-brand-50 text-sm text-gray-700 font-medium">👤 Profile</a>
        <a href="<?= url('/logout') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-brand-500 text-white text-sm font-medium mt-2">↪ Logout</a>
    </div>
</nav>

<script>
document.getElementById('menuBtn').addEventListener('click', function() {
    document.getElementById('mobileMenu').classList.toggle('hidden');
});
</script>
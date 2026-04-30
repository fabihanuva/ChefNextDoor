<?php use App\Core\Session; ?>
<nav class="bg-white border-b border-brand-100 px-4 py-3 sticky top-0 z-50">
    <div class="flex items-center justify-between">
        <a href="<?= url('/chef-dashboard') ?>" class="flex items-center gap-2">
            <img src="/ChefNextDoor/assets/images/chefnextdoor_logo.jpeg" alt="ChefNextDoor" class="w-8 h-8 object-contain" />
            <span class="text-base font-bold text-brand-600">ChefNextDoor</span>
        </a>

        <!-- Desktop -->
        <div class="hidden md:flex items-center gap-3">
            <a href="<?= url('/dishes') ?>" class="text-sm text-gray-500 hover:text-brand-600">🍽️ Dishes</a>
            <a href="<?= url('/chef/orders') ?>" class="text-sm text-gray-500 hover:text-brand-600">📦 Orders</a>
            <a href="<?= url('/chef/profile') ?>" class="text-sm text-gray-500 hover:text-brand-600">👨‍🍳 Profile</a>
            <a href="<?= url('/logout') ?>" class="text-sm bg-brand-500 hover:bg-brand-600 text-white px-4 py-2 rounded-xl font-medium transition-colors">Logout</a>
        </div>

        <!-- Mobile hamburger -->
        <button id="chefMenuBtn" class="md:hidden p-2 rounded-xl hover:bg-brand-50 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
    </div>

    <!-- Mobile menu -->
    <div id="chefMobileMenu" class="hidden md:hidden mt-3 pb-2 border-t border-brand-50 pt-3 space-y-1">
        <a href="<?= url('/chef-dashboard') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-brand-50 text-sm text-gray-700 font-medium">🏠 Dashboard</a>
        <a href="<?= url('/dishes') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-brand-50 text-sm text-gray-700 font-medium">🍽️ My Dishes</a>
        <a href="<?= url('/dishes/create') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-brand-50 text-sm text-gray-700 font-medium">➕ Add Dish</a>
        <a href="<?= url('/chef/orders') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-brand-50 text-sm text-gray-700 font-medium">📦 Manage Orders</a>
        <a href="<?= url('/chef/reviews') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-brand-50 text-sm text-gray-700 font-medium">⭐ My Reviews</a>
        <a href="<?= url('/chef/profile') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-brand-50 text-sm text-gray-700 font-medium">👨‍🍳 My Profile</a>
        <a href="<?= url('/logout') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-brand-500 text-white text-sm font-medium mt-2">↪ Logout</a>
    </div>
</nav>

<script>
document.getElementById('chefMenuBtn').addEventListener('click', function() {
    document.getElementById('chefMobileMenu').classList.toggle('hidden');
});
</script>
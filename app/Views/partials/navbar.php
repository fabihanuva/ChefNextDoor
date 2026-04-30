<?php use App\Core\Session; 
$user = Session::get('user');
$cartCount = array_sum(array_column(Session::get('cart') ?? [], 'quantity'));
?>
<nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-brand-100 px-4 sm:px-6 py-3">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex items-center gap-2">
            <a href="<?= url($user ? ($user['role'] === 'chef' ? '/chef-dashboard' : '/dashboard') : '/') ?>" class="flex items-center gap-2 group">
                <div class="w-9 h-9 sm:w-10 sm:h-10 bg-white rounded-xl flex items-center justify-center shadow-lg shadow-brand-200 transition-transform group-hover:scale-105 overflow-hidden p-1">
                    <img src="<?= url('/../assets/images/chefnextdoor_logo.jpeg') ?>" alt="Logo" class="w-full h-full object-contain" />
                </div>
                <span class="text-lg sm:text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-brand-600 to-orange-500">ChefNextDoor</span>
            </a>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center gap-6">
            <?php if ($user): ?>
                <?php if ($user['role'] === 'chef'): ?>
                    <div class="flex items-center gap-6 text-sm font-medium text-gray-500">
                        <a href="<?= url('/chef-dashboard') ?>" class="hover:text-brand-600 transition-colors">Dashboard</a>
                        <a href="<?= url('/dishes') ?>" class="hover:text-brand-600 transition-colors">My Dishes</a>
                        <a href="<?= url('/chef/orders') ?>" class="hover:text-brand-600 transition-colors">Orders</a>
                    </div>
                <?php else: ?>
                    <div class="flex items-center gap-6 text-sm font-medium text-gray-500">
                        <a href="<?= url('/dashboard') ?>" class="hover:text-brand-600 transition-colors">Home</a>
                        <a href="<?= url('/browse') ?>" class="hover:text-brand-600 transition-colors">Browse</a>
                        <a href="<?= url('/orders/history') ?>" class="hover:text-brand-600 transition-colors">My Orders</a>
                    </div>
                <?php endif; ?>

                <div class="h-6 w-px bg-gray-100 mx-2"></div>

                <div class="flex items-center gap-4">
                    <?php if ($user['role'] !== 'chef'): ?>
                        <a href="<?= url('/cart') ?>" class="relative p-2 text-gray-500 hover:text-brand-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                            <?php if ($cartCount > 0): ?>
                                <span class="absolute top-0 right-0 bg-brand-500 text-white text-[10px] font-bold w-4 h-4 flex items-center justify-center rounded-full border-2 border-white"><?= $cartCount ?></span>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>

                    <div class="relative group">
                        <button class="flex items-center gap-2 p-1 pr-3 rounded-full hover:bg-gray-50 transition-colors">
                            <div class="w-8 h-8 rounded-full bg-brand-100 flex items-center justify-center text-brand-600 font-bold text-sm">
                                <?= strtoupper(substr($user['name'], 0, 1)) ?>
                            </div>
                            <span class="text-sm font-medium text-gray-700 hidden lg:block"><?= e($user['name']) ?></span>
                        </button>
                        <div class="absolute right-0 top-full pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <div class="bg-white border border-brand-100 rounded-2xl shadow-xl py-2 min-w-[160px]">
                                <a href="<?= url('/profile') ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-600 hover:bg-brand-50 hover:text-brand-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    Profile
                                </a>
                                <?php if ($user['role'] === 'chef'): ?>
                                    <a href="<?= url('/chef/profile') ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-600 hover:bg-brand-50 hover:text-brand-600 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="3" r="4"/><path d="M3 7V5c0-1.1.9-2 2-2h2"/><path d="M3 17v2c0 1.1.9 2 2 2h2"/><path d="M21 17v2c0 1.1-.9 2-2 2h-2"/><path d="M21 7V5c0-1.1-.9-2-2-2h-2"/></svg>
                                        Chef Bio
                                    </a>
                                <?php endif; ?>
                                <div class="h-px bg-gray-50 my-1"></div>
                                <a href="<?= url('/logout') ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="flex items-center gap-4">
                    <a href="<?= url('/login') ?>" class="text-sm font-medium text-gray-500 hover:text-brand-600 transition-colors">Login</a>
                    <a href="<?= url('/register') ?>" class="bg-brand-500 hover:bg-brand-600 text-white px-5 py-2 rounded-xl text-sm font-semibold transition-colors shadow-lg shadow-brand-100">Sign Up</a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Mobile Menu Button -->
        <div class="flex md:hidden items-center gap-4">
            <?php if ($user && $user['role'] !== 'chef'): ?>
                <a href="<?= url('/cart') ?>" class="relative p-2 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                    <?php if ($cartCount > 0): ?>
                        <span class="absolute top-0 right-0 bg-brand-500 text-white text-[9px] font-bold w-4 h-4 flex items-center justify-center rounded-full border-2 border-white"><?= $cartCount ?></span>
                    <?php endif; ?>
                </a>
            <?php endif; ?>
            <button id="mobileMenuBtn" class="p-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                <svg id="menuIcon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                <svg id="closeIcon" class="hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Dropdown -->
    <div id="mobileMenu" class="hidden md:hidden mt-4 pb-4 border-t border-gray-100 animate-in fade-in slide-in-from-top-4 duration-200">
        <div class="flex flex-col gap-2 mt-4">
            <?php if ($user): ?>
                <?php if ($user['role'] === 'chef'): ?>
                    <a href="<?= url('/chef-dashboard') ?>" class="px-4 py-3 text-sm font-semibold text-gray-600 hover:bg-brand-50 hover:text-brand-600 rounded-xl transition-colors">Dashboard</a>
                    <a href="<?= url('/dishes') ?>" class="px-4 py-3 text-sm font-semibold text-gray-600 hover:bg-brand-50 hover:text-brand-600 rounded-xl transition-colors">My Dishes</a>
                    <a href="<?= url('/chef/orders') ?>" class="px-4 py-3 text-sm font-semibold text-gray-600 hover:bg-brand-50 hover:text-brand-600 rounded-xl transition-colors">Orders</a>
                <?php else: ?>
                    <a href="<?= url('/dashboard') ?>" class="px-4 py-3 text-sm font-semibold text-gray-600 hover:bg-brand-50 hover:text-brand-600 rounded-xl transition-colors">Home</a>
                    <a href="<?= url('/browse') ?>" class="px-4 py-3 text-sm font-semibold text-gray-600 hover:bg-brand-50 hover:text-brand-600 rounded-xl transition-colors">Browse Dishes</a>
                    <a href="<?= url('/orders/history') ?>" class="px-4 py-3 text-sm font-semibold text-gray-600 hover:bg-brand-50 hover:text-brand-600 rounded-xl transition-colors">My Orders</a>
                    <a href="<?= url('/favorites') ?>" class="px-4 py-3 text-sm font-semibold text-gray-600 hover:bg-brand-50 hover:text-brand-600 rounded-xl transition-colors">Favourites</a>
                <?php endif; ?>
                <div class="h-px bg-gray-100 my-2"></div>
                <a href="<?= url('/profile') ?>" class="px-4 py-3 text-sm font-semibold text-gray-600 hover:bg-brand-50 rounded-xl transition-colors">My Profile</a>
                <?php if ($user['role'] === 'chef'): ?>
                    <a href="<?= url('/chef/profile') ?>" class="px-4 py-3 text-sm font-semibold text-gray-600 hover:bg-brand-50 rounded-xl transition-colors">Chef Bio</a>
                <?php endif; ?>
                <a href="<?= url('/logout') ?>" class="px-4 py-3 text-sm font-semibold text-red-600 hover:bg-red-50 rounded-xl transition-colors">Logout</a>
            <?php else: ?>
                <a href="<?= url('/login') ?>" class="px-4 py-3 text-sm font-semibold text-gray-600 hover:bg-brand-50 rounded-xl transition-colors">Login</a>
                <a href="<?= url('/register') ?>" class="mx-4 mt-2 bg-brand-500 text-white px-4 py-3 rounded-xl text-sm font-bold text-center shadow-lg shadow-brand-100">Sign Up Free</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script>
    document.getElementById('mobileMenuBtn').addEventListener('click', function() {
        const menu = document.getElementById('mobileMenu');
        const menuIcon = document.getElementById('menuIcon');
        const closeIcon = document.getElementById('closeIcon');
        
        const isHidden = menu.classList.contains('hidden');
        
        if (isHidden) {
            menu.classList.remove('hidden');
            menuIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
        } else {
            menu.classList.add('hidden');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        }
    });
</script>
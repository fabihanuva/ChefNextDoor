<?php
$title = 'ChefNextDoor — From Their Home to Your Heart';
ob_start();
?>

<!-- Navbar -->
<nav class="bg-white border-b border-brand-100 px-4 py-3 flex items-center justify-between sticky top-0 z-50">
    <div class="flex items-center gap-2">
        <img src="/ChefNextDoor/assets/images/chefnextdoor_logo.jpeg" alt="ChefNextDoor" class="w-8 h-8 object-contain" />
        <span class="text-base font-bold text-brand-600">ChefNextDoor</span>
    </div>
    <div class="flex items-center gap-2">
        <a href="<?= url('/login') ?>" class="text-xs text-gray-500 hover:text-brand-600 font-medium transition-colors px-2 py-1">Sign In</a>
        <a href="<?= url('/register') ?>" class="text-xs bg-brand-500 hover:bg-brand-600 text-white px-3 py-2 rounded-xl font-medium transition-colors">Get Started</a>
    </div>
</nav>

<!-- Hero Section -->
<div class="bg-brand-500 py-20 px-6">
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center gap-12">
        <div class="flex-1 text-center md:text-left">
            <span class="inline-block bg-white bg-opacity-20 text-white text-xs font-bold px-3 py-1 rounded-full mb-4 uppercase tracking-wider">Home-Cooked Food Delivery</span>
            <h1 class="text-4xl md:text-5xl font-black text-white leading-tight mb-4">
                Taste the warmth of<br/>
                <span class="text-brand-200">home cooking</span>
            </h1>
            <p class="text-brand-100 text-lg mb-8 leading-relaxed">
                Connect with talented home chefs in your community. Order authentic, freshly made meals delivered straight to your door.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center md:justify-start">
                <a href="<?= url('/register') ?>" class="bg-white text-brand-600 font-bold px-8 py-3 rounded-xl hover:bg-brand-50 transition-colors text-center">
                    Order Food Now
                </a>
                <a href="<?= url('/register') ?>" class="border-2 border-white text-white font-bold px-8 py-3 rounded-xl hover:bg-white hover:bg-opacity-10 transition-colors text-center">
                    Become a Chef
                </a>
            </div>
        </div>
        <div class="flex-shrink-0">
            <img src="/ChefNextDoor/assets/images/chefnextdoor_logo.jpeg" alt="ChefNextDoor" class="w-56 h-56 object-contain drop-shadow-2xl" />
        </div>
    </div>
</div>

<!-- Stats Bar -->
<div class="bg-brand-600 py-6 px-6">
    <div class="max-w-4xl mx-auto grid grid-cols-3 gap-6 text-center">
        <div>
            <p class="text-3xl font-black text-white">50+</p>
            <p class="text-brand-200 text-sm mt-1">Home Chefs</p>
        </div>
        <div>
            <p class="text-3xl font-black text-white">200+</p>
            <p class="text-brand-200 text-sm mt-1">Dishes Available</p>
        </div>
        <div>
            <p class="text-3xl font-black text-white">★ 4.8</p>
            <p class="text-brand-200 text-sm mt-1">Average Rating</p>
        </div>
    </div>
</div>

<!-- How It Works -->
<div class="bg-brand-50 py-16 px-6">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-black text-gray-900 mb-3">How It Works</h2>
            <p class="text-gray-500">Order delicious home-cooked food in 3 simple steps</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl border border-brand-100 p-8 text-center">
                <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4">👨‍🍳</div>
                <h3 class="font-bold text-gray-800 text-lg mb-2">1. Choose a Chef</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Browse home chefs in your area. Read their bios, specialties and customer reviews.</p>
            </div>
            <div class="bg-white rounded-2xl border border-brand-100 p-8 text-center">
                <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4">🍽️</div>
                <h3 class="font-bold text-gray-800 text-lg mb-2">2. Pick Your Dishes</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Explore their menu and add your favourite home-cooked meals to your cart.</p>
            </div>
            <div class="bg-white rounded-2xl border border-brand-100 p-8 text-center">
                <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4">🚴</div>
                <h3 class="font-bold text-gray-800 text-lg mb-2">3. Get It Delivered</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Place your order and track it live from the chef's kitchen to your door.</p>
            </div>
        </div>
    </div>
</div>

<!-- For Chefs -->
<div class="bg-white py-16 px-6">
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center gap-12">
        <div class="flex-1">
            <span class="inline-block bg-brand-50 text-brand-600 text-xs font-bold px-3 py-1 rounded-full mb-4 uppercase tracking-wider">For Home Chefs</span>
            <h2 class="text-3xl font-black text-gray-900 mb-4">Turn your passion into income</h2>
            <p class="text-gray-500 leading-relaxed mb-6">Are you a great home cook? Join ChefNextDoor and start selling your meals to food lovers in your community.</p>
            <div class="space-y-3 mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 rounded-full bg-brand-500 flex items-center justify-center text-white text-xs font-bold">✓</div>
                    <span class="text-gray-700 text-sm">Set your own prices and menu</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 rounded-full bg-brand-500 flex items-center justify-center text-white text-xs font-bold">✓</div>
                    <span class="text-gray-700 text-sm">Accept or reject orders on your schedule</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 rounded-full bg-brand-500 flex items-center justify-center text-white text-xs font-bold">✓</div>
                    <span class="text-gray-700 text-sm">Track your earnings and ratings</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 rounded-full bg-brand-500 flex items-center justify-center text-white text-xs font-bold">✓</div>
                    <span class="text-gray-700 text-sm">Build your reputation with customer reviews</span>
                </div>
            </div>
            <a href="<?= url('/register') ?>" class="inline-block bg-brand-500 hover:bg-brand-600 text-white font-bold px-8 py-3 rounded-xl transition-colors">
                Start Cooking and Earning →
            </a>
        </div>
        <div class="flex-1 grid grid-cols-2 gap-3">
            <div class="bg-brand-50 rounded-2xl p-4 text-center">
                <p class="text-2xl font-black text-brand-600 mb-1">৳0</p>
                <p class="text-gray-500 text-xs">Registration fee</p>
            </div>
            <div class="bg-brand-50 rounded-2xl p-4 text-center">
                <p class="text-2xl font-black text-brand-600 mb-1">100%</p>
                <p class="text-gray-500 text-xs">You set the prices</p>
            </div>
            <div class="bg-brand-50 rounded-2xl p-4 text-center">
                <p class="text-2xl font-black text-brand-600 mb-1">Live</p>
                <p class="text-gray-500 text-xs">Order tracking</p>
            </div>
            <div class="bg-brand-50 rounded-2xl p-4 text-center">
                <p class="text-2xl font-black text-brand-600 mb-1">⭐ 5</p>
                <p class="text-gray-500 text-xs">Star rating system</p>
            </div>
        </div>
    </div>
</div>

<!-- Categories -->
<div class="bg-brand-50 py-16 px-6">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-black text-gray-900 mb-3">Explore Food Categories</h2>
            <p class="text-gray-500">From traditional Bangladeshi cuisine to international flavours</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <?php
            $categories = [
                ['🍚', 'Rice'], ['🍛', 'Curry'], ['🥣', 'Soup'], ['🥗', 'Salad'],
                ['🍮', 'Dessert'], ['🥪', 'Snacks'], ['🥤', 'Drinks'], ['🍱', 'Other'],
            ];
            foreach ($categories as [$icon, $name]):
            ?>
            <div class="bg-white rounded-2xl border border-brand-100 p-5 text-center hover:border-brand-400 transition-colors">
                <div class="text-3xl mb-2"><?= $icon ?></div>
                <p class="font-semibold text-gray-700 text-sm"><?= $name ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="bg-brand-500 py-16 px-6 text-center">
    <div class="max-w-2xl mx-auto">
        <h2 class="text-3xl font-black text-white mb-4">Ready to taste home?</h2>
        <p class="text-brand-100 mb-8 leading-relaxed">Join hundreds of food lovers who are already enjoying authentic home-cooked meals from talented chefs in their community.</p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="<?= url('/register') ?>" class="bg-white text-brand-600 font-bold px-8 py-3 rounded-xl hover:bg-brand-50 transition-colors">
                Create Free Account
            </a>
            <a href="<?= url('/login') ?>" class="border-2 border-white text-white font-bold px-8 py-3 rounded-xl hover:bg-white hover:bg-opacity-10 transition-colors">
                Sign In
            </a>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
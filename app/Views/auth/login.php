<?php
use App\Core\Session;
$title = 'Login | ChefNextDoor';
ob_start();
?>
<div class="min-h-screen flex flex-col md:flex-row">

    <!-- Left Panel — Splash -->
    <div class="hidden md:flex md:w-1/2 bg-brand-500 flex-col items-center justify-center px-12 py-16">
        <img src="/ChefNextDoor/assets/images/chefnextdoor_logo.jpeg"
             alt="ChefNextDoor Logo"
             class="w-64 h-64 object-contain mb-8 drop-shadow-2xl" />
        <h1 class="text-4xl font-black text-white text-center leading-tight mb-3">
            ChefNextDoor
        </h1>
        <p class="text-brand-100 text-center text-lg font-medium">
            From Their Home to Your Heart
        </p>
        <div class="mt-12 grid grid-cols-3 gap-6 text-center">
            <div>
                <p class="text-3xl font-black text-white">50+</p>
                <p class="text-brand-200 text-xs font-medium mt-1">Home Chefs</p>
            </div>
            <div>
                <p class="text-3xl font-black text-white">200+</p>
                <p class="text-brand-200 text-xs font-medium mt-1">Dishes</p>
            </div>
            <div>
                <p class="text-3xl font-black text-white">★ 4.8</p>
                <p class="text-brand-200 text-xs font-medium mt-1">Avg Rating</p>
            </div>
        </div>
    </div>

    <!-- Right Panel — Login Form -->
    <div class="flex-1 flex items-center justify-center px-6 py-12 bg-brand-50">
        <div class="w-full max-w-md">

            <!-- Mobile logo -->
            <div class="flex flex-col items-center mb-8 md:hidden">
                <img src="/ChefNextDoor/assets/images/chefnextdoor_logo.jpeg"
                     alt="ChefNextDoor Logo"
                     class="w-32 h-32 object-contain mb-3 drop-shadow-lg" />
                <h1 class="text-2xl font-black text-brand-600">ChefNextDoor</h1>
                <p class="text-gray-400 text-sm">From Their Home to Your Heart</p>
            </div>

            <h2 class="text-3xl font-black text-gray-900 mb-2">Welcome back!</h2>
            <p class="text-gray-400 mb-8 text-sm">Sign in to order delicious home-cooked meals</p>

            <?php if (Session::get('error')): ?>
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                    <?= htmlspecialchars(Session::get('error')) ?>
                    <?php Session::remove('error'); ?>
                </div>
            <?php endif; ?>

            <?php if (Session::get('success')): ?>
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                    <?= htmlspecialchars(Session::get('success')) ?>
                    <?php Session::remove('success'); ?>
                </div>
            <?php endif; ?>

            <div class="card-base p-8">
                <form method="POST" action="<?= url('/login') ?>" class="space-y-5">
                    <?= csrf_field() ?>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                        <input type="email" name="email" required placeholder="name@example.com"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm" />
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" required placeholder="••••••••"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm" />
                    </div>
                    <button type="submit"
                        class="w-full bg-brand-500 hover:bg-brand-600 text-white font-bold py-3 rounded-xl transition-colors text-sm">
                        Sign In →
                    </button>
                </form>

                <div class="mt-6 pt-6 border-t border-gray-50 text-center">
                    <p class="text-sm text-gray-500">
                        Don't have an account?
                        <a href="<?= url('/register') ?>" class="text-brand-600 font-bold hover:underline">Create one free</a>
                    </p>
                </div>
            </div>

            <p class="text-center text-xs text-gray-300 mt-6">
                By signing in, you agree to our
                <a href="<?= url('/terms') ?>" class="underline">Terms</a> and
                <a href="<?= url('/privacy') ?>" class="underline">Privacy Policy</a>.
            </p>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';

<?php
use App\Core\Session;
$title = 'Register | ChefNextDoor';
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
        <div class="mt-12 space-y-4 w-full max-w-xs">
            <div class="bg-white bg-opacity-10 rounded-2xl p-4 flex items-center gap-4">
                <span class="text-3xl">👨‍🍳</span>
                <div>
                    <p class="text-white font-bold text-sm">Become a Chef</p>
                    <p class="text-brand-200 text-xs">Share your home-cooked meals</p>
                </div>
            </div>
            <div class="bg-white bg-opacity-10 rounded-2xl p-4 flex items-center gap-4">
                <span class="text-3xl">🛒</span>
                <div>
                    <p class="text-white font-bold text-sm">Order as Customer</p>
                    <p class="text-brand-200 text-xs">Enjoy authentic home food</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Panel — Register Form -->
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

            <h2 class="text-3xl font-black text-gray-900 mb-2">Create an account</h2>
            <p class="text-gray-400 mb-8 text-sm">Join our community of home chefs and food lovers</p>

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
                <form method="POST" action="<?= url('/register') ?>" class="space-y-4">
                    <?= csrf_field() ?>
                    
                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                        <input type="text" name="name" required placeholder="e.g. Fabiha Nuva"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm" />
                    </div>

                    <!-- Role -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">I want to...</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="role" value="customer" class="peer sr-only" required />
                                <div class="flex flex-col items-center justify-center border-2 border-gray-200 rounded-xl py-4 text-sm text-gray-600 peer-checked:border-brand-500 peer-checked:bg-brand-50 peer-checked:text-brand-700 font-medium transition-all">
                                    <span class="text-2xl mb-1">🛒</span>
                                    Order Food
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="role" value="chef" class="peer sr-only" />
                                <div class="flex flex-col items-center justify-center border-2 border-gray-200 rounded-xl py-4 text-sm text-gray-600 peer-checked:border-brand-500 peer-checked:bg-brand-50 peer-checked:text-brand-700 font-medium transition-all">
                                    <span class="text-2xl mb-1">👨‍🍳</span>
                                    Cook & Sell
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                        <input type="email" name="email" required placeholder="name@example.com"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" required placeholder="At least 6 characters"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm" />
                    </div>

                    <button type="submit"
                        class="w-full bg-brand-500 hover:bg-brand-600 text-white font-bold py-3 rounded-xl transition-colors text-sm">
                        Create Account →
                    </button>
                </form>

                <div class="mt-6 pt-6 border-t border-gray-50 text-center">
                    <p class="text-sm text-gray-500">
                        Already have an account?
                        <a href="<?= url('/login') ?>" class="text-brand-600 font-bold hover:underline">Sign in</a>
                    </p>
                </div>
            </div>

            <p class="text-center text-xs text-gray-300 mt-6">
                By registering, you agree to our
                <a href="<?= url('/terms') ?>" class="underline">Terms</a> and
                <a href="<?= url('/privacy') ?>" class="underline">Privacy Policy</a>.
            </p>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
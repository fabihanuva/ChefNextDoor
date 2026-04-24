<?php
use App\Core\Session;
$title = 'Join ChefNextDoor';
ob_start();
?>
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">

        <!-- Logo -->
        <div class="text-center mb-8">
            <span class="text-4xl">🍳</span>
            <h1 class="text-3xl font-bold text-brand-600 mt-2">ChefNextDoor</h1>
            <p class="text-gray-500 mt-1 text-sm">Home-cooked food, delivered with love</p>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-orange-100 p-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Create your account</h2>

            <!-- Flash messages -->
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

            <form method="POST" action="<?= url('/register') ?>" class="space-y-4">

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" required placeholder="e.g. Fabiha Nuva"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm" />
                </div>

                <!-- Role -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">I am a...</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="customer" class="peer sr-only" required />
                            <div class="flex flex-col items-center justify-center border border-gray-200 rounded-xl py-3 text-sm text-gray-600 peer-checked:border-brand-500 peer-checked:bg-brand-50 peer-checked:text-brand-700 font-medium transition-all">
                                <span class="text-2xl mb-1">🛒</span>
                                Customer
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="chef" class="peer sr-only" />
                            <div class="flex flex-col items-center justify-center border border-gray-200 rounded-xl py-3 text-sm text-gray-600 peer-checked:border-brand-500 peer-checked:bg-brand-50 peer-checked:text-brand-700 font-medium transition-all">
                                <span class="text-2xl mb-1">👨‍🍳</span>
                                Chef
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" required placeholder="you@example.com"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm" />
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required placeholder="At least 6 characters"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm" />
                </div>

                <button type="submit"
                    class="w-full bg-brand-500 hover:bg-brand-600 text-white font-semibold py-2.5 rounded-xl transition-colors text-sm mt-2">
                    Create Account
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-5">
                Already have an account?
                <a href="<?= url('/login') ?>" class="text-brand-600 font-medium hover:underline">Sign in</a>
            </p>
        </div>

    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
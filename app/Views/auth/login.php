<?php
use App\Core\Session;
$title = 'Login | ChefNextDoor';
ob_start();
?>
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <span class="text-4xl">🍳</span>
            <h1 class="text-3xl font-bold text-brand-600 mt-2">ChefNextDoor</h1>
            <p class="text-gray-500 mt-1 text-sm">Welcome back! Ready to eat?</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-orange-100 p-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Sign in to your account</h2>

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

            <form method="POST" action="<?= url('/login') ?>" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" required placeholder="you@example.com"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required placeholder="Your password"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm" />
                </div>
                <button type="submit"
                    class="w-full bg-brand-500 hover:bg-brand-600 text-white font-semibold py-2.5 rounded-xl transition-colors text-sm mt-2">
                    Sign In
                </button>
            </form>
            <p class="text-center text-sm text-gray-500 mt-5">
                Don't have an account?
                <a href="<?= url('/register') ?>" class="text-brand-600 font-medium hover:underline">Register</a>
            </p>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
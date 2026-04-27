<?php
use App\Core\Session;
$title = 'Login | ChefNextDoor';
ob_start();
?>
<div class="min-h-[80vh] flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-brand-500 rounded-3xl shadow-xl shadow-brand-100 text-4xl mb-6 transform hover:rotate-6 transition-transform">
                🍳
            </div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Welcome back</h1>
            <p class="text-slate-500 mt-2">Ready for some delicious home-cooked meals?</p>
        </div>

        <div class="card-base p-10 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-500 to-orange-400"></div>
            
            <form method="POST" action="<?= url('/login') ?>" class="space-y-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                    <input type="email" name="email" required placeholder="name@example.com"
                        class="input-base" />
                </div>
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-sm font-bold text-slate-700">Password</label>
                        <a href="#" class="text-xs font-bold text-brand-600 hover:text-brand-700 transition-colors">Forgot password?</a>
                    </div>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="input-base" />
                </div>
                
                <button type="submit" class="btn-primary w-full py-4 text-base">
                    Sign In
                </button>
            </form>

            <div class="mt-8 pt-8 border-t border-gray-50 text-center">
                <p class="text-sm text-slate-500">
                    Don't have an account yet?
                    <a href="<?= url('/register') ?>" class="text-brand-600 font-bold hover:underline">Create an account</a>
                </p>
            </div>
        </div>
        
        <p class="text-center text-xs text-slate-400 mt-10">
            By signing in, you agree to our 
            <a href="#" class="underline">Terms of Service</a> and 
            <a href="#" class="underline">Privacy Policy</a>.
        </p>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';

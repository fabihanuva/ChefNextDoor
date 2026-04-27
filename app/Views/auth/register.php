<?php
use App\Core\Session;
$title = 'Join ChefNextDoor';
ob_start();
?>
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-lg">

        <!-- Logo -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-brand-500 rounded-3xl shadow-xl shadow-brand-100 text-4xl mb-6 transform hover:-rotate-6 transition-transform">
                🍳
            </div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Create your account</h1>
            <p class="text-slate-500 mt-2">Join our community of food lovers and talented chefs.</p>
        </div>

        <!-- Card -->
        <div class="card-base p-10 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-500 to-orange-400"></div>

            <form method="POST" action="<?= url('/register') ?>" class="space-y-6">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Full Name</label>
                        <input type="text" name="name" required placeholder="e.g. Fabiha Nuva"
                            class="input-base" />
                    </div>

                    <!-- Role Selection -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-3 text-center">I want to...</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="group relative cursor-pointer">
                                <input type="radio" name="role" value="customer" class="peer sr-only" required checked />
                                <div class="flex flex-col items-center justify-center border-2 border-slate-100 rounded-2xl py-6 px-4 text-slate-500 peer-checked:border-brand-500 peer-checked:bg-brand-50 peer-checked:text-brand-700 transition-all group-hover:border-brand-200">
                                    <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🛒</span>
                                    <span class="font-bold text-sm">Buy Food</span>
                                    <p class="text-[10px] text-center mt-1 opacity-60">Order fresh home meals</p>
                                </div>
                                <div class="absolute -top-2 -right-2 hidden peer-checked:flex w-6 h-6 bg-brand-500 rounded-full border-4 border-white items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M20 6 9 17 4 12"/></svg>
                                </div>
                            </label>
                            <label class="group relative cursor-pointer">
                                <input type="radio" name="role" value="chef" class="peer sr-only" />
                                <div class="flex flex-col items-center justify-center border-2 border-slate-100 rounded-2xl py-6 px-4 text-slate-500 peer-checked:border-brand-500 peer-checked:bg-brand-50 peer-checked:text-brand-700 transition-all group-hover:border-brand-200">
                                    <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">👨‍🍳</span>
                                    <span class="font-bold text-sm">Sell Food</span>
                                    <p class="text-[10px] text-center mt-1 opacity-60">Share your cooking</p>
                                </div>
                                <div class="absolute -top-2 -right-2 hidden peer-checked:flex w-6 h-6 bg-brand-500 rounded-full border-4 border-white items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M20 6 9 17 4 12"/></svg>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                        <input type="email" name="email" required placeholder="you@example.com"
                            class="input-base" />
                    </div>

                    <!-- Password -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Create Password</label>
                        <input type="password" name="password" required placeholder="Min. 6 characters"
                            class="input-base" />
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full py-4 text-base mt-4 shadow-xl shadow-brand-100">
                    Create Account
                </button>
            </form>

            <div class="mt-8 pt-8 border-t border-gray-50 text-center">
                <p class="text-sm text-slate-500">
                    Already have an account?
                    <a href="<?= url('/login') ?>" class="text-brand-600 font-bold hover:underline">Sign in instead</a>
                </p>
            </div>
        </div>

    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';

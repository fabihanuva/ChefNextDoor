<?php
use App\Core\Session;
$title = 'My Profile | ChefNextDoor';
ob_start();
?>
<div class="max-w-4xl mx-auto px-6 py-12">
    <div class="flex items-center gap-4 mb-10">
        <a href="<?= url($user['role'] === 'chef' ? '/chef-dashboard' : '/dashboard') ?>" class="p-2 rounded-full hover:bg-white transition-colors text-slate-400 hover:text-brand-600">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Account Settings</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <!-- Sidebar Navigation -->
        <div class="space-y-1">
            <a href="#profile" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-brand-50 text-brand-700 font-bold transition-all shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Personal Info
            </a>
            <a href="#security" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-white hover:text-slate-800 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                Security
            </a>
            <a href="<?= url('/logout') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 hover:bg-red-50 transition-all mt-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                Logout
            </a>
        </div>

        <!-- Main Form Area -->
        <div class="md:col-span-2 space-y-8">
            <!-- Profile Info Card -->
            <div id="profile" class="card-base p-8">
                <div class="flex items-center gap-6 mb-8 pb-8 border-b border-gray-50">
                    <div class="w-20 h-20 rounded-2xl bg-brand-100 flex items-center justify-center text-3xl font-bold text-brand-600 shadow-inner">
                        <?= strtoupper(substr($user['name'], 0, 1)) ?>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-800"><?= e($user['name']) ?></h2>
                        <p class="text-slate-400 text-sm"><?= e($user['email']) ?></p>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-brand-50 text-brand-600 uppercase tracking-wider mt-2">
                            <?= $user['role'] ?> account
                        </span>
                    </div>
                </div>

                <form method="POST" action="<?= url('/profile/update') ?>" class="space-y-6">
                    <?= csrf_field() ?>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Full Name</label>
                        <input type="text" name="name" required value="<?= e($user['name']) ?>"
                            class="input-base" placeholder="Your full name" />
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                        <input type="email" value="<?= e($user['email']) ?>" disabled
                            class="input-base bg-slate-50 border-slate-100 text-slate-400 cursor-not-allowed" />
                        <p class="text-xs text-slate-400 mt-2 italic">Contact support to change your email address.</p>
                    </div>
                    <div class="pt-2">
                        <button type="submit" class="btn-primary w-full sm:w-auto">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>

            <!-- Security Card -->
            <div id="security" class="card-base p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 bg-slate-100 rounded-lg text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/></svg>
                    </div>
                    <h2 class="text-xl font-bold text-slate-800">Password & Security</h2>
                </div>

                <form method="POST" action="<?= url('/profile/password') ?>" class="space-y-6">
                    <?= csrf_field() ?>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Current Password</label>
                        <input type="password" name="current_password" required placeholder="••••••••"
                            class="input-base" />
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">New Password</label>
                            <input type="password" name="new_password" required placeholder="Min. 6 chars"
                                class="input-base" />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Confirm New Password</label>
                            <input type="password" name="confirm_password" required placeholder="Repeat new password"
                                class="input-base" />
                        </div>
                    </div>
                    <div class="pt-2">
                        <button type="submit"
                            class="bg-slate-800 hover:bg-slate-900 text-white font-bold px-8 py-3 rounded-xl transition-all shadow-lg active:scale-95 text-sm">
                            Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';

<?php
use App\Core\Session;
$title = 'Chef Profile Settings | ChefNextDoor';
ob_start();
?>
<div class="max-w-4xl mx-auto px-6 py-12">
    <div class="flex items-center gap-4 mb-10">
        <a href="<?= url('/chef-dashboard') ?>" class="p-2 rounded-full hover:bg-white transition-colors text-slate-400 hover:text-brand-600">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Chef Profile Settings</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <!-- Sidebar -->
        <div class="space-y-1">
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-brand-50 text-brand-700 font-bold transition-all shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Public Bio
            </a>
            <a href="<?= url('/profile') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-white hover:text-slate-800 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                Security
            </a>
            <a href="<?= url('/chef/profile/public?id=' . $user['id']) ?>" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-xl text-brand-600 hover:bg-brand-50 transition-all mt-4 border border-brand-100 border-dashed">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                View Public Profile
            </a>
        </div>

        <!-- Main Form Area -->
        <div class="md:col-span-2 space-y-8">
            <div class="card-base p-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-500 to-orange-400"></div>
                
                <div class="flex items-center gap-6 mb-8 pb-8 border-b border-gray-50">
                    <div class="w-20 h-20 rounded-2xl bg-brand-100 flex items-center justify-center text-3xl font-bold text-brand-600 shadow-inner">
                        <?= strtoupper(substr($user['name'], 0, 1)) ?>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-800"><?= htmlspecialchars($user['name']) ?></h2>
                        <p class="text-slate-400 text-sm">Update your public chef profile to attract more customers.</p>
                    </div>
                </div>

                <form method="POST" action="<?= url('/chef/profile/update') ?>" class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Professional Bio</label>
                        <textarea name="bio" rows="4" placeholder="Tell customers about your culinary journey, experience, and why they should choose your food..."
                            class="input-base resize-none"><?= htmlspecialchars($profile['bio'] ?? '') ?></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Primary Specialty</label>
                            <input type="text" name="specialty" placeholder="e.g. Authentic Bengali Cuisine"
                                value="<?= htmlspecialchars($profile['specialty'] ?? '') ?>"
                                class="input-base" />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Kitchen Location</label>
                            <input type="text" name="location" placeholder="e.g. Gulshan, Dhaka"
                                value="<?= htmlspecialchars($profile['location'] ?? '') ?>"
                                class="input-base" />
                        </div>
                    </div>

                    <div class="pt-4 flex items-center gap-4">
                        <button type="submit" class="btn-primary !px-10">
                            Save Chef Profile
                        </button>
                    </div>
                </form>
            </div>

            <!-- Help Card -->
            <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 flex items-start gap-4">
                <div class="text-blue-500 mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-blue-900 mb-1">Why complete your profile?</h4>
                    <p class="text-xs text-blue-700 leading-relaxed">
                        Complete profiles receive up to 3x more orders! Customers love knowing who's cooking their food and where it's coming from. Make your bio personal and inviting.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';

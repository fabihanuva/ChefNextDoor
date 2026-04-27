<?php
use App\Core\Session;
$title = 'My Profile | ChefNextDoor';
ob_start();
?>
<div class="min-h-screen bg-brand-50">
    <nav class="bg-white border-b border-orange-100 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-2xl">🍳</span>
            <span class="text-lg font-bold text-brand-600">ChefNextDoor</span>
        </div>
        <div class="flex items-center gap-4">
            <?php if ($user['role'] === 'chef'): ?>
                <a href="<?= url('/chef-dashboard') ?>" class="text-sm text-gray-500 hover:text-brand-600">← Dashboard</a>
            <?php else: ?>
                <a href="<?= url('/dashboard') ?>" class="text-sm text-gray-500 hover:text-brand-600">← Dashboard</a>
            <?php endif; ?>
            <a href="<?= url('/logout') ?>" class="text-sm bg-brand-500 hover:bg-brand-600 text-white px-4 py-2 rounded-xl font-medium transition-colors">Logout</a>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-6 py-10">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">👤 My Profile</h1>

        <?php if (Session::get('success')): ?>
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                <?= htmlspecialchars(Session::get('success')) ?>
                <?php Session::remove('success'); ?>
            </div>
        <?php endif; ?>

        <?php if (Session::get('error')): ?>
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                <?= htmlspecialchars(Session::get('error')) ?>
                <?php Session::remove('error'); ?>
            </div>
        <?php endif; ?>

        <!-- Profile Info -->
        <div class="bg-white rounded-2xl border border-orange-100 p-6 mb-5">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 rounded-full bg-brand-100 flex items-center justify-center text-3xl font-bold text-brand-600">
                    <?= strtoupper(substr($user['name'], 0, 1)) ?>
                </div>
                <div>
                    <p class="font-bold text-gray-800 text-lg"><?= htmlspecialchars($user['name']) ?></p>
                    <p class="text-sm text-gray-400"><?= htmlspecialchars($user['email']) ?></p>
                    <span class="text-xs px-2 py-0.5 rounded-full bg-brand-50 text-brand-600 capitalize font-medium"><?= $user['role'] ?></span>
                </div>
            </div>

            <form method="POST" action="<?= url('/profile/update') ?>" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" required value="<?= htmlspecialchars($user['name']) ?>"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" value="<?= htmlspecialchars($user['email']) ?>" disabled
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm text-gray-400" />
                    <p class="text-xs text-gray-400 mt-1">Email cannot be changed.</p>
                </div>
                <button type="submit"
                    class="bg-brand-500 hover:bg-brand-600 text-white font-semibold px-6 py-2.5 rounded-xl transition-colors text-sm">
                    Save Changes
                </button>
            </form>
        </div>

        <!-- Change Password -->
        <div class="bg-white rounded-2xl border border-orange-100 p-6">
            <h2 class="font-semibold text-gray-800 mb-4">🔒 Change Password</h2>
            <form method="POST" action="<?= url('/profile/password') ?>" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                    <input type="password" name="current_password" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input type="password" name="new_password" required placeholder="At least 6 characters"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                    <input type="password" name="confirm_password" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm" />
                </div>
                <button type="submit"
                    class="bg-gray-800 hover:bg-gray-900 text-white font-semibold px-6 py-2.5 rounded-xl transition-colors text-sm">
                    Change Password
                </button>
            </form>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
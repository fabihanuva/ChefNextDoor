<?php
$title = '404 | ChefNextDoor';
ob_start();
?>
<div class="min-h-screen bg-brand-50 flex items-center justify-center px-4">
    <div class="text-center">
        <div class="text-8xl mb-6">🍳</div>
        <h1 class="text-6xl font-bold text-brand-500 mb-2">404</h1>
        <h2 class="text-2xl font-semibold text-gray-700 mb-3">Page Not Found</h2>
        <p class="text-gray-400 text-sm mb-8">Looks like this dish isn't on the menu!</p>
        <div class="flex gap-3 justify-center">
            <a href="<?= url('/dashboard') ?>"
                class="bg-brand-500 hover:bg-brand-600 text-white font-semibold px-6 py-2.5 rounded-xl transition-colors text-sm">
                Go to Dashboard
            </a>
            <a href="<?= url('/browse') ?>"
                class="border border-orange-200 hover:bg-brand-50 text-brand-600 font-semibold px-6 py-2.5 rounded-xl transition-colors text-sm">
                Browse Dishes
            </a>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';

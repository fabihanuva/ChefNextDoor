<?php
use App\Core\Session;
$title = 'Community Feed | ChefNextDoor';
ob_start();
?>
<div class="max-w-3xl mx-auto px-6 py-12">
    <div class="mb-10">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Community Feed</h1>
        <p class="text-slate-500 mt-2">Share your thoughts and experiences with the ChefNextDoor community.</p>
    </div>

    <!-- Post Form -->
    <div class="card-base p-6 mb-10 overflow-hidden relative">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-500 to-orange-400"></div>
        <form method="POST" action="<?= url('/posts') ?>" id="postForm" class="space-y-4">
            <?= csrf_field() ?>
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-brand-100 flex items-center justify-center text-brand-600 font-bold shrink-0">
                    <?= strtoupper(substr($user['name'], 0, 1)) ?>
                </div>
                <div class="flex-grow">
                    <textarea name="content" 
                        class="w-full bg-slate-50 border-transparent focus:bg-white focus:ring-2 focus:ring-brand-400 rounded-xl p-4 text-sm text-slate-700 placeholder-slate-400 min-h-[100px] transition-all outline-none resize-none" 
                        placeholder="What's cooking, <?= e($user['name']) ?>?" required></textarea>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="btn-primary !py-2 !px-8 text-sm">
                    Post Update
                </button>
            </div>
        </form>
    </div>

    <!-- Feed Container -->
    <div class="space-y-6" id="postsContainer">
        <div class="flex flex-col items-center justify-center py-20 text-slate-400">
            <svg class="animate-spin h-8 w-8 mb-4 text-brand-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="text-sm font-medium">Fetching the latest updates...</p>
        </div>
    </div>
</div>

<!-- Pass the base path to JavaScript so fetch URLs work in subdirectories -->
<script>var BASE_PATH = <?= json_encode(rtrim(getenv('BASE_PATH') ?: '', '/')) ?>;</script>
<script src="<?= url('/assets/posts.js') ?>"></script>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';

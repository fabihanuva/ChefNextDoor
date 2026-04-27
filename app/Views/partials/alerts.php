<?php
use App\Core\Session;
?>
<div class="fixed top-20 right-6 z-[60] flex flex-col gap-3 w-full max-w-sm pointer-events-none">
    <?php if (Session::get('success')): ?>
        <div class="bg-white border-l-4 border-green-500 shadow-2xl rounded-xl p-4 flex items-start gap-3 pointer-events-auto animate-in slide-in-from-right duration-300">
            <div class="bg-green-100 p-1 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-600"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div class="flex-1">
                <p class="text-sm font-semibold text-gray-800">Success!</p>
                <p class="text-xs text-gray-500 mt-0.5"><?= htmlspecialchars(Session::get('success')) ?></p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-gray-300 hover:text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <?php Session::remove('success'); ?>
    <?php endif; ?>

    <?php if (Session::get('error')): ?>
        <div class="bg-white border-l-4 border-red-500 shadow-2xl rounded-xl p-4 flex items-start gap-3 pointer-events-auto animate-in slide-in-from-right duration-300">
            <div class="bg-red-100 p-1 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-600"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            </div>
            <div class="flex-1">
                <p class="text-sm font-semibold text-gray-800">Error</p>
                <p class="text-xs text-gray-500 mt-0.5"><?= htmlspecialchars(Session::get('error')) ?></p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-gray-300 hover:text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <?php Session::remove('error'); ?>
    <?php endif; ?>
</div>

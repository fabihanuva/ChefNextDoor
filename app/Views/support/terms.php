<?php $title = 'Terms of Service | ChefNextDoor'; ob_start(); ?>

<!-- Navbar -->
<?php include __DIR__ . '/../partials/navbar.php'; ?>

<div class="max-w-3xl mx-auto px-6 py-16">
    <h1 class="text-4xl font-black text-gray-900 mb-3">Terms of Service</h1>
    <p class="text-gray-400 text-sm mb-10">Last updated: <?= date('d F Y') ?></p>
    <div class="card-base p-8 space-y-6 text-gray-600 leading-relaxed">
        <h2 class="text-xl font-bold text-gray-800">1. Acceptance of Terms</h2>
        <p>By using ChefNextDoor, you agree to these terms. If you do not agree, please do not use our platform.</p>
        <h2 class="text-xl font-bold text-gray-800">2. User Accounts</h2>
        <p>You are responsible for maintaining the confidentiality of your account credentials. You must provide accurate information when registering.</p>
        <h2 class="text-xl font-bold text-gray-800">3. Chef Responsibilities</h2>
        <p>Chefs are responsible for ensuring food safety, accurate descriptions, and timely delivery of orders placed through the platform.</p>
        <h2 class="text-xl font-bold text-gray-800">4. Customer Responsibilities</h2>
        <p>Customers must provide accurate delivery addresses and are responsible for being available to receive their orders.</p>
        <h2 class="text-xl font-bold text-gray-800">5. Payments</h2>
        <p>All prices are listed in Bangladeshi Taka (৳). A delivery fee of ৳50 is added to all orders.</p>
        <h2 class="text-xl font-bold text-gray-800">6. Changes to Terms</h2>
        <p>We reserve the right to modify these terms at any time. Continued use of the platform constitutes acceptance of the new terms.</p>
    </div>
</div>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>

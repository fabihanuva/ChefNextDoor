<?php $title = 'Privacy Policy | ChefNextDoor'; ob_start(); ?>

<!-- Navbar -->
<?php include __DIR__ . '/../partials/navbar.php'; ?>

<div class="max-w-3xl mx-auto px-6 py-16">
    <h1 class="text-4xl font-black text-gray-900 mb-3">Privacy Policy</h1>
    <p class="text-gray-400 text-sm mb-10">Last updated: <?= date('d F Y') ?></p>
    <div class="card-base p-8 space-y-6 text-gray-600 leading-relaxed">
        <h2 class="text-xl font-bold text-gray-800">1. Information We Collect</h2>
        <p>We collect information you provide when registering, including your name, email address, and role. We also collect order and delivery information.</p>
        <h2 class="text-xl font-bold text-gray-800">2. How We Use Your Information</h2>
        <p>Your information is used to process orders, improve our service, and communicate with you about your account and orders.</p>
        <h2 class="text-xl font-bold text-gray-800">3. Data Security</h2>
        <p>We use industry-standard security measures including password hashing and prepared statements to protect your data.</p>
        <h2 class="text-xl font-bold text-gray-800">4. Sharing of Information</h2>
        <p>We do not sell your personal information. Order details are shared only between the relevant customer and chef.</p>
        <h2 class="text-xl font-bold text-gray-800">5. Contact Us</h2>
        <p>If you have questions about this privacy policy, please contact us through the Help Center.</p>
    </div>
</div>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>

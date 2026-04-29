<?php $title = 'Help Center | ChefNextDoor'; ob_start(); ?>
<div class="max-w-3xl mx-auto px-6 py-16">
    <h1 class="text-4xl font-black text-gray-900 mb-3">Help Center</h1>
    <p class="text-gray-500 mb-10">Find answers to common questions about ChefNextDoor.</p>
    <div class="space-y-4">
        <?php $faqs = [
            ['q' => 'How do I place an order?', 'a' => 'Browse chefs, select a chef, add dishes to your cart, then proceed to checkout and enter your delivery address.'],
            ['q' => 'How do I become a chef?', 'a' => 'Register an account and select "Chef" as your role. Once registered, set up your profile and start adding dishes.'],
            ['q' => 'Can I cancel an order?', 'a' => 'Orders can only be cancelled while they are in "Pending" status. Once accepted by the chef, cancellation is not available.'],
            ['q' => 'How do I track my order?', 'a' => 'Go to My Orders and click "Track Order" to see the live status of your order.'],
            ['q' => 'How do I leave a review?', 'a' => 'After an order is delivered, go to My Orders and click "Leave a Review" to rate and comment on your experience.'],
            ['q' => 'What is the delivery fee?', 'a' => 'A flat delivery fee of ৳50 is added to all orders.'],
        ]; ?>
        <?php foreach ($faqs as $faq): ?>
            <div class="card-base p-6">
                <h3 class="font-bold text-gray-800 mb-2">❓ <?= $faq['q'] ?></h3>
                <p class="text-gray-500 text-sm"><?= $faq['a'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>

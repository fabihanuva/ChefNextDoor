<?php $title = 'About Us | ChefNextDoor'; ob_start(); ?>
<div class="max-w-3xl mx-auto px-6 py-16">
    <div class="text-center mb-12">
        <img src="/ChefNextDoor/assets/images/chefnextdoor_logo.jpeg" class="w-24 h-24 object-contain mx-auto mb-4" />
        <h1 class="text-4xl font-black text-gray-900 mb-3">About ChefNextDoor</h1>
        <p class="text-brand-600 font-medium text-lg">From Their Home to Your Heart</p>
    </div>
    <div class="card-base p-8 space-y-6 text-gray-600 leading-relaxed">
        <p>ChefNextDoor is a platform that connects food lovers with passionate home chefs in their community. We believe that the best food comes from home kitchens — made with love, tradition, and care.</p>
        <p>Our mission is to give talented home cooks a platform to share their culinary skills while giving customers access to authentic, homemade meals that remind them of home.</p>
        <h2 class="text-xl font-bold text-gray-800 pt-4">Our Story</h2>
        <p>Founded with a simple idea — that great food shouldn't be limited to restaurants — ChefNextDoor brings together chefs and customers in a community built on trust, taste, and tradition.</p>
        <h2 class="text-xl font-bold text-gray-800 pt-4">Our Values</h2>
        <ul class="space-y-2 list-disc list-inside">
            <li>Authenticity — real home-cooked food</li>
            <li>Community — supporting local home chefs</li>
            <li>Quality — every dish made with care</li>
            <li>Trust — safe and reliable ordering</li>
        </ul>
    </div>
    <div class="text-center mt-8">
        <a href="<?= url('/register') ?>" class="btn-primary">Join ChefNextDoor</a>
    </div>
</div>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>

<?php
ob_start();
?>
<div class="max-w-4xl mx-auto px-6 py-16">
    <div class="card-base p-12 bg-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-2 bg-slate-900"></div>
        
        <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-8">Terms of Service</h1>
        <p class="text-sm text-slate-400 mb-10 italic">Last updated: April 27, 2026</p>

        <div class="space-y-10 prose prose-slate max-w-none">
            <section>
                <h2 class="text-xl font-bold text-slate-800 mb-4">1. Acceptance of Terms</h2>
                <p class="text-slate-600 leading-relaxed">
                    By accessing and using the ChefNextDoor platform, you agree to be bound by these Terms of Service. If you do not agree to all of these terms, please do not use the service.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-slate-800 mb-4">2. Description of Service</h2>
                <p class="text-slate-600 leading-relaxed">
                    ChefNextDoor provides a marketplace connecting independent home chefs with customers seeking home-cooked meals. We do not prepare food ourselves; all meals are prepared by independent chefs who are solely responsible for the quality, safety, and delivery of their products.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-slate-800 mb-4">3. User Obligations</h2>
                <ul class="list-disc pl-6 space-y-2 text-slate-600">
                    <li>Users must provide accurate information during registration.</li>
                    <li>Chefs are responsible for maintaining high hygiene standards and complying with local health regulations.</li>
                    <li>Customers agree to provide accurate delivery information and pay for all orders placed.</li>
                </ul>
            </section>

            <section>
                <h2 class="text-xl font-bold text-slate-800 mb-4">4. Payments and Fees</h2>
                <p class="text-slate-600 leading-relaxed">
                    All prices are set by the chefs. ChefNextDoor may charge a small service fee for facilitating the transaction. Payment terms are negotiated between the customer and the chef, typically upon delivery or through our integrated payment system.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-slate-800 mb-4">5. Limitation of Liability</h2>
                <p class="text-slate-600 leading-relaxed">
                    ChefNextDoor is not liable for any health issues, allergic reactions, or dissatisfaction arising from the consumption of food prepared by independent chefs on our platform.
                </p>
            </section>

            <section class="pt-8 border-t border-gray-100">
                <p class="text-sm text-slate-500">
                    If you have any questions regarding these terms, please contact us at 
                    <a href="mailto:legal@chefnextdoor.com" class="text-brand-600 font-bold hover:underline">legal@chefnextdoor.com</a>.
                </p>
            </section>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';

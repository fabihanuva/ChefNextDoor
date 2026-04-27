<?php
ob_start();
?>
<div class="max-w-4xl mx-auto px-6 py-16">
    <div class="card-base p-12 bg-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-2 bg-brand-500"></div>
        
        <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-8">Privacy Policy</h1>
        <p class="text-sm text-slate-400 mb-10 italic">Last updated: April 27, 2026</p>

        <div class="space-y-10 prose prose-slate max-w-none">
            <section>
                <h2 class="text-xl font-bold text-slate-800 mb-4">1. Information We Collect</h2>
                <p class="text-slate-600 leading-relaxed mb-4">
                    When you register on ChefNextDoor, we collect personal information such as your name, email address, and physical address for delivery purposes.
                </p>
                <p class="text-slate-600 leading-relaxed">
                    Chefs may provide additional information including professional background and kitchen location to build their public profile.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-slate-800 mb-4">2. How We Use Your Information</h2>
                <ul class="list-disc pl-6 space-y-2 text-slate-600">
                    <li>To facilitate orders and deliveries between customers and chefs.</li>
                    <li>To improve our platform and user experience.</li>
                    <li>To send important service updates and promotional offers.</li>
                    <li>To ensure the security and integrity of our community.</li>
                </ul>
            </section>

            <section>
                <h2 class="text-xl font-bold text-slate-800 mb-4">3. Data Sharing</h2>
                <p class="text-slate-600 leading-relaxed">
                    We share relevant delivery information (name, address, phone number) with the independent chef preparing your order. We never sell your personal data to third-party advertisers.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-slate-800 mb-4">4. Cookies and Tracking</h2>
                <p class="text-slate-600 leading-relaxed">
                    ChefNextDoor uses cookies to maintain your session and remember your preferences. This helps provide a seamless login experience and keeps your cart items saved.
                </p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-slate-800 mb-4">5. Your Rights</h2>
                <p class="text-slate-600 leading-relaxed">
                    You have the right to access, correct, or delete your personal information at any time through your account settings or by contacting our support team.
                </p>
            </section>

            <section class="pt-8 border-t border-gray-100">
                <p class="text-sm text-slate-500">
                    If you have concerns about your privacy, please reach out to our Data Protection Officer at 
                    <a href="mailto:privacy@chefnextdoor.com" class="text-brand-600 font-bold hover:underline">privacy@chefnextdoor.com</a>.
                </p>
            </section>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';

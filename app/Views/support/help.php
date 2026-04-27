<?php
ob_start();
?>
<div class="max-w-4xl mx-auto px-6 py-16">
    <div class="mb-12">
        <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-2">Help Center</h1>
        <p class="text-lg text-slate-500">Everything you need to know about using ChefNextDoor.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-16">
        <div class="md:col-span-2 space-y-6">
            <h2 class="text-2xl font-bold text-slate-800 mb-6">Frequently Asked Questions</h2>
            
            <div class="card-base p-6">
                <h3 class="font-bold text-slate-900 mb-2">How do I place an order?</h3>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Simply browse the dishes available in your area, add your favorites to the cart, and proceed to checkout. You'll need to provide a delivery address and confirm your order.
                </p>
            </div>

            <div class="card-base p-6">
                <h3 class="font-bold text-slate-900 mb-2">How can I become a chef?</h3>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Register for an account and select the "Chef" role during signup. Once logged in, you can complete your profile and start listing your home-cooked dishes immediately.
                </p>
            </div>

            <div class="card-base p-6">
                <h3 class="font-bold text-slate-900 mb-2">How are delivery times handled?</h3>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Each chef manages their own preparation and delivery. You can track the status of your order in real-time from your "My Orders" dashboard.
                </p>
            </div>

            <div class="card-base p-6">
                <h3 class="font-bold text-slate-900 mb-2">What if I have an issue with my order?</h3>
                <p class="text-sm text-slate-600 leading-relaxed">
                    We recommend contacting the chef directly if possible. If you need further assistance, our support team is always here to help resolve any disputes.
                </p>
            </div>
        </div>

        <div class="space-y-6">
            <h2 class="text-2xl font-bold text-slate-800 mb-6">Contact Us</h2>
            
            <div class="card-base p-6 bg-brand-50 border-brand-100">
                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-brand-600"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                </div>
                <h3 class="font-bold text-slate-900 mb-1">Email Support</h3>
                <p class="text-xs text-slate-500 mb-4">Response time: 24-48 hours</p>
                <a href="mailto:support@chefnextdoor.com" class="text-sm font-bold text-brand-600 hover:underline">support@chefnextdoor.com</a>
            </div>

            <div class="card-base p-6">
                <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center shadow-sm mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-600"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.74 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                </div>
                <h3 class="font-bold text-slate-900 mb-1">Phone</h3>
                <p class="text-xs text-slate-500 mb-4">Mon-Fri: 9am - 6pm</p>
                <a href="tel:+8801234567890" class="text-sm font-bold text-slate-700 hover:text-brand-600 transition-colors">+880 1234 567890</a>
            </div>
        </div>
    </div>

    <div class="bg-slate-50 rounded-3xl p-10 text-center">
        <h2 class="text-2xl font-bold text-slate-800 mb-4">Can't find what you're looking for?</h2>
        <p class="text-slate-500 mb-8 max-w-lg mx-auto">Our specialized support team is ready to help you with any platform-related questions or technical difficulties.</p>
        <button class="btn-primary !px-10">Start a Live Chat</button>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';

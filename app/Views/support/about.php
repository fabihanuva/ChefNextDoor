<?php
ob_start();
?>
<div class="max-w-4xl mx-auto px-6 py-16">
    <div class="text-center mb-16">
        <h1 class="text-5xl font-black text-slate-900 tracking-tight mb-4">Our Mission</h1>
        <p class="text-xl text-slate-500 max-w-2xl mx-auto leading-relaxed">
            Bringing the authentic taste of home-cooked meals to every neighborhood, while empowering local culinary talent.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-20">
        <div>
            <h2 class="text-3xl font-bold text-slate-900 mb-6 tracking-tight">What is ChefNextDoor?</h2>
            <p class="text-slate-600 leading-relaxed mb-4">
                ChefNextDoor is a community-driven platform that connects passionate home chefs with hungry neighbors. We believe that the best food isn't found in a restaurant kitchen, but in the heart of a home.
            </p>
            <p class="text-slate-600 leading-relaxed">
                Whether you're looking for a healthy weeknight dinner or a specialized traditional dish that you can't find elsewhere, ChefNextDoor brings the warmth and quality of home cooking directly to your doorstep.
            </p>
        </div>
        <div class="card-base p-2 bg-gradient-to-br from-brand-500 to-orange-400 rotate-2 shadow-2xl">
            <div class="bg-white p-8 rounded-xl h-full flex flex-col items-center justify-center text-center">
                <span class="text-6xl mb-4">🍳</span>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Authentic Flavors</h3>
                <p class="text-sm text-slate-500">Real food, made by real people, with real love.</p>
            </div>
        </div>
    </div>

    <div class="mb-20">
        <h2 class="text-3xl font-bold text-slate-900 mb-10 tracking-tight text-center">Why We're Different</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600 text-3xl mx-auto mb-4">🏠</div>
                <h4 class="font-bold text-slate-800 mb-2 tracking-tight">Community First</h4>
                <p class="text-sm text-slate-500">We prioritize local connections and supporting the people in your neighborhood.</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 text-3xl mx-auto mb-4">✨</div>
                <h4 class="font-bold text-slate-800 mb-2 tracking-tight">Quality Ingredients</h4>
                <p class="text-sm text-slate-500">Home chefs cook with the same high-quality ingredients they serve to their own families.</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 text-3xl mx-auto mb-4">🚀</div>
                <h4 class="font-bold text-slate-800 mb-2 tracking-tight">Empowering Talent</h4>
                <p class="text-sm text-slate-500">We provide the tools for home cooks to build their own culinary businesses from home.</p>
            </div>
        </div>
    </div>

    <div class="card-base p-12 bg-slate-900 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-brand-500/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
        <div class="relative z-10 text-center">
            <h2 class="text-3xl font-bold mb-4">Ready to start your journey?</h2>
            <p class="text-slate-400 mb-8 max-w-xl mx-auto">Join thousands of food lovers and talented chefs who are already part of the ChefNextDoor community.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="<?= url('/register') ?>" class="bg-brand-500 hover:bg-brand-600 text-white font-bold py-3 px-8 rounded-xl transition-all shadow-lg shadow-brand-500/20">Sign Up Now</a>
                <a href="<?= url('/browse') ?>" class="bg-white/10 hover:bg-white/20 text-white font-bold py-3 px-8 rounded-xl transition-all border border-white/20">Explore Dishes</a>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';

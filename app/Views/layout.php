<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars($title ?? 'ChefNextDoor') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50:  '#fff7ed',
                            100: '#ffedd5',
                            200: '#fed7aa',
                            300: '#fdba74',
                            400: '#fb923c',
                            500: '#f97316',
                            600: '#ea580c',
                            700: '#c2410c',
                            800: '#9a3412',
                            900: '#7c2d12',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        [xl-cloak] { display: none !important; }
        .glass { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); }
        .btn-primary { @apply bg-brand-500 hover:bg-brand-600 text-white font-semibold py-2.5 px-6 rounded-xl transition-all duration-200 shadow-lg shadow-brand-100 active:scale-[0.98]; }
        .input-base { @apply w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 focus:border-transparent transition-all duration-200 text-sm; }
        .card-base { @apply bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen font-sans text-slate-900 flex flex-col">
    <?php include __DIR__ . '/partials/navbar.php'; ?>
    <?php include __DIR__ . '/partials/alerts.php'; ?>

    <main class="flex-grow">
        <?= $content ?? '' ?>
    </main>

    <footer class="bg-white border-t border-gray-100 py-12 mt-20">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 bg-brand-500 rounded-lg flex items-center justify-center text-white text-lg">🍳</div>
                    <span class="text-lg font-bold text-gray-800">ChefNextDoor</span>
                </div>
                <p class="text-sm text-gray-500 max-w-xs leading-relaxed">
                    Connecting food lovers with passionate home chefs. Experience the taste of home, delivered to your door.
                </p>
            </div>
            <div>
                <h4 class="font-bold text-gray-800 mb-4 text-sm uppercase tracking-wider">Quick Links</h4>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li><a href="<?= url('/browse') ?>" class="hover:text-brand-600 transition-colors">Browse Dishes</a></li>
                    <li><a href="<?= url('/register') ?>" class="hover:text-brand-600 transition-colors">Become a Chef</a></li>
                    <li><a href="<?= url('/about') ?>" class="hover:text-brand-600 transition-colors">About Us</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-gray-800 mb-4 text-sm uppercase tracking-wider">Support</h4>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li><a href="<?= url('/help') ?>" class="hover:text-brand-600 transition-colors">Help Center</a></li>
                    <li><a href="<?= url('/terms') ?>" class="hover:text-brand-600 transition-colors">Terms of Service</a></li>
                    <li><a href="<?= url('/privacy') ?>" class="hover:text-brand-600 transition-colors">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-6xl mx-auto px-6 mt-12 pt-8 border-t border-gray-50 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-xs text-gray-400">© <?= date('Y') ?> ChefNextDoor. All rights reserved.</p>
            <div class="flex gap-6">
                <!-- Social Icons would go here -->
            </div>
        </div>
    </footer>
</body>
</html>
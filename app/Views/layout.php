<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars($title ?? 'ChefNextDoor') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    .btn-primary {
        display: inline-flex;
        align-items: center;
        background-color: #2D6A4F;
        color: white;
        font-weight: 600;
        padding: 0.625rem 1.25rem;
        border-radius: 0.75rem;
        transition: background-color 0.2s;
        gap: 0.5rem;
    }
    .btn-primary:hover { background-color: #245a42; }
    .card-base {
        background: white;
        border-radius: 1rem;
        border: 1px solid #d6ebe2;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
</style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50:  '#f0f7f4',
                            100: '#d6ebe2',
                            200: '#a8d5bf',
                            300: '#72b99a',
                            400: '#4a9a7a',
                            500: '#2D6A4F',
                            600: '#245a42',
                            700: '#1a4a35',
                            800: '#123326',
                            900: '#0a1f17',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-brand-50 min-h-screen font-sans text-gray-800 flex flex-col">

    <main class="flex-grow">
        <?= $content ?? '' ?>
    </main>

    <footer class="bg-white border-t border-brand-100 py-10 mt-16">
        <div class="max-w-5xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="text-2xl">🍳</span>
                    <span class="text-lg font-bold text-brand-600">ChefNextDoor</span>
                </div>
                <p class="text-sm text-gray-500 leading-relaxed">From Their Home to Your Heart</p>
            </div>
            <div>
                <h4 class="font-bold text-gray-700 mb-3 text-sm uppercase tracking-wider">Quick Links</h4>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li><a href="<?= url('/browse') ?>" class="hover:text-brand-600 transition-colors">Browse Dishes</a></li>
                    <li><a href="<?= url('/register') ?>" class="hover:text-brand-600 transition-colors">Become a Chef</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-gray-700 mb-3 text-sm uppercase tracking-wider">Account</h4>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li><a href="<?= url('/login') ?>" class="hover:text-brand-600 transition-colors">Login</a></li>
                    <li><a href="<?= url('/register') ?>" class="hover:text-brand-600 transition-colors">Register</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-5xl mx-auto px-6 mt-8 pt-6 border-t border-brand-50">
            <p class="text-xs text-gray-400 text-center">© <?= date('Y') ?> ChefNextDoor. All rights reserved.</p>
        </div>
    </footer>
    <!-- Toast notification -->
    <?php
    $toast = \App\Core\Session::get('success');
    if ($toast) \App\Core\Session::remove('success');
    ?>
    <?php if ($toast): ?>
    <div id="toast"
        class="fixed bottom-6 right-6 bg-brand-500 text-white px-5 py-3 rounded-2xl shadow-lg text-sm font-medium flex items-center gap-2 z-50">
        <?= htmlspecialchars($toast) ?>
    </div>
    <script>
        setTimeout(() => {
            const t = document.getElementById('toast');
            if (t) {
                t.style.transition = 'opacity 0.5s';
                t.style.opacity = '0';
                setTimeout(() => t.remove(), 500);
            }
        }, 2500);
    </script>
    <?php endif; ?>

</body>
</html>
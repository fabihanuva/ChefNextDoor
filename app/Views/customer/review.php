<?php
use App\Core\Session;
$title = 'Leave a Review | ChefNextDoor';
ob_start();
?>
<div class="min-h-screen bg-brand-50">
    <nav class="bg-white border-b border-orange-100 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-2xl">🍳</span>
            <span class="text-lg font-bold text-brand-600">ChefNextDoor</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="<?= url('/orders/history') ?>" class="text-sm text-gray-500 hover:text-brand-600">← My Orders</a>
            <a href="<?= url('/logout') ?>" class="text-sm bg-brand-500 hover:bg-brand-600 text-white px-4 py-2 rounded-xl font-medium transition-colors">Logout</a>
        </div>
    </nav>

    <div class="max-w-lg mx-auto px-6 py-10">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">⭐ Leave a Review</h1>

        <div class="bg-white rounded-2xl border border-orange-100 p-8">
            <p class="text-sm text-gray-500 mb-6">Order #<?= $order['id'] ?> — Share your experience!</p>

            <form method="POST" action="<?= url('/review/submit') ?>" class="space-y-5">
                <input type="hidden" name="order_id" value="<?= $order['id'] ?>" />

                <!-- Star rating -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Your Rating *</label>
                    <div class="flex gap-2" id="stars">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <label class="cursor-pointer">
                                <input type="radio" name="rating" value="<?= $i ?>" class="sr-only" required />
                                <span class="text-3xl star-btn transition-all" data-value="<?= $i ?>">☆</span>
                            </label>
                        <?php endfor; ?>
                    </div>
                </div>

                <!-- Comment -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Comment</label>
                    <textarea name="comment" rows="4" placeholder="Tell us about your experience..."
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-400 text-sm resize-none"></textarea>
                </div>

                <button type="submit"
                    class="w-full bg-brand-500 hover:bg-brand-600 text-white font-semibold py-2.5 rounded-xl transition-colors text-sm">
                    Submit Review ⭐
                </button>
            </form>
        </div>
    </div>
</div>

<script>
const stars = document.querySelectorAll('.star-btn');
stars.forEach(star => {
    star.addEventListener('click', () => {
        const val = parseInt(star.dataset.value);
        stars.forEach((s, i) => {
            s.textContent = i < val ? '★' : '☆';
            s.style.color  = i < val ? '#f97316' : '#d1d5db';
        });
    });
    star.addEventListener('mouseover', () => {
        const val = parseInt(star.dataset.value);
        stars.forEach((s, i) => {
            s.textContent = i < val ? '★' : '☆';
            s.style.color  = i < val ? '#f97316' : '#d1d5db';
        });
    });
});
document.getElementById('stars').addEventListener('mouseleave', () => {
    const checked = document.querySelector('input[name="rating"]:checked');
    const val = checked ? parseInt(checked.value) : 0;
    stars.forEach((s, i) => {
        s.textContent = i < val ? '★' : '☆';
        s.style.color  = i < val ? '#f97316' : '#d1d5db';
    });
});
</script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
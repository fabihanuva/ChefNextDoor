<?php
use App\Core\Session;
$title = 'Posts | AuthBoard';
ob_start();
?>

<?php if (Session::get('success')): ?>
    <div class="message success">
        <?= htmlspecialchars(Session::get('success')) ?>
        <?php Session::remove('success'); ?>
    </div>
<?php endif; ?>

<?php if (Session::get('error')): ?>
    <div class="message error">
        <?= htmlspecialchars(Session::get('error')) ?>
        <?php Session::remove('error'); ?>
    </div>
<?php endif; ?>

<h2>Posts</h2>

<div class="post-form">
    <form method="POST" action="<?= url('/posts') ?>" id="postForm">
        <textarea name="content" placeholder="What's on your mind, <?= htmlspecialchars($user['name']) ?>?" required></textarea>
        <button type="submit">Post</button>
    </form>
</div>

<div class="posts-container" id="postsContainer">
    <div class="loading">Loading posts...</div>
</div>

<!-- Pass the base path to JavaScript so fetch URLs work in subdirectories -->
<script>var BASE_PATH = <?= json_encode(rtrim(getenv('BASE_PATH') ?: '', '/')) ?>;</script>
<script src="<?= url('/assets/posts.js') ?>"></script>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $title ?? 'AuthBoard' ?></title>
    <link rel="stylesheet" href="<?= url('/assets/style.css') ?>">
</head>
<body>
<div class="container">
    <header>
        <h1>AuthBoard</h1>
        <?php if (!empty($_SESSION['user'])): ?>
            <nav><a href="<?= url('/dashboard') ?>">Dashboard</a> | <a href="<?= url('/posts') ?>">Posts</a> | <a href="<?= url('/logout') ?>">Logout</a></nav>
        <?php endif; ?>
    </header>

    <main>
        <?php echo $content ; ?>
    </main>

    <footer>
        <small>AuthBoard - teaching project</small>
    </footer>
</div>
</body>
</html>

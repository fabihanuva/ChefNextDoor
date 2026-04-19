<?php
use App\Core\Session;
$title = 'Dashboard | AuthBoard';
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

<h2>Welcome, <?php echo  htmlspecialchars($user['name']) ?></h2>
<p>Your email: <?= htmlspecialchars($user['email']) ?></p>

<div class="email-test-card">
    <h3>Email Testing</h3>
    <p>
        Test your Mailtrap integration by sending a test email to <strong><?= htmlspecialchars($user['email']) ?></strong>
    </p>
    <a href="<?= url('/test-mail') ?>" class="btn btn-success"
       onclick="return confirm('Send a test email to <?= htmlspecialchars($user['email']) ?>?');">
        Send Test Email
    </a>
    <p class="hint">
        Check your <a href="https://mailtrap.io/inboxes" target="_blank">Mailtrap inbox</a> to see the email.
    </p>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';

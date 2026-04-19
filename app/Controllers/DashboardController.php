<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;

class DashboardController extends Controller {

    // Customer Dashboard
    public function index() {
        $user = requireAuth();

        // Restrict: only customers
        if ($user['role'] !== 'customer') {
            header("Location: /ChefNextDoor/public/login");
            exit;
        }

        $this->view('dashboard.php', ['user' => $user]);
    }

    // Chef Dashboard
    public function chef() {
        $user = requireAuth();

        // Restrict: only chefs
        if ($user['role'] !== 'chef') {
            header("Location: /ChefNextDoor/public/login");
            exit;
        }

        // For now simple output (you can replace with view later)
        echo "Welcome to Chef Dashboard, " . $user['name'];
    }

    // Test Mail Feature
    public function testMail() {
        $user = requireAuth();

        $to = $user['email'];
        $subject = 'Test Email from AuthBoard';

        $body = "Hello {$user['name']},\n\n";
        $body .= "This is a test email to verify that Mailtrap integration is working correctly.\n\n";
        $body .= "If you received this email, your email configuration is set up properly!\n\n";
        $body .= "Sent at: " . date('Y-m-d H:i:s') . "\n\n";
        $body .= "Best regards,\nAuthBoard Team";

        $result = \App\Core\Mailer::send($to, $subject, $body);

        if ($result) {
            Session::set('success', 'Test email sent successfully!');
        } else {
            Session::set('error', 'Failed to send test email.');
        }

        // FIXED redirect
        header("Location: /ChefNextDoor/public/dashboard");
        exit;
    }
}
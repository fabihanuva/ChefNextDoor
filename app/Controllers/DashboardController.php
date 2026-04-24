<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;

class DashboardController extends Controller {

    public function index() {
        $user = requireAuth();

        if ($user['role'] !== 'customer') {
            header("Location: " . url('/chef-dashboard'));
            exit;
        }

        $this->view('dashboard.php', ['user' => $user]);
    }

    public function chef() {
        $user = requireAuth();

        if ($user['role'] !== 'chef') {
            header("Location: " . url('/dashboard'));
            exit;
        }

        $this->view('chef-dashboard.php', ['user' => $user]);
    }

    public function testMail() {
        $user = requireAuth();

        $result = \App\Core\Mailer::send(
            $user['email'],
            'Welcome to ChefNextDoor',
            "Hello {$user['name']},\n\nThanks for joining ChefNextDoor!\n\nSent at: " . date('Y-m-d H:i:s')
        );

        if ($result) {
            Session::set('success', 'Test email sent successfully!');
        } else {
            Session::set('error', 'Failed to send test email.');
        }

        header("Location: " . url('/dashboard'));
        exit;
    }
}
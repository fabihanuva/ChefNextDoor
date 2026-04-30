<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Mailer;
use App\Models\User;

class AuthController extends Controller {

    public function showHome() {
        // If already logged in redirect to dashboard
        $user = \App\Core\Session::get('user');
        if ($user) {
            if ($user['role'] === 'chef') {
                header("Location: " . url('/chef-dashboard'));
            } else {
                header("Location: " . url('/dashboard'));
           }
            exit;
    }
        $this->view('home.php');
    }

    public function showLogin() {
        $user = \App\Core\Session::get('user');
        if ($user) {
            if ($user['role'] === 'chef') {
                header("Location: " . url('/chef-dashboard'));
            } else {
                header("Location: " . url('/dashboard'));
            }
            exit;
        }
        $this->view('auth/login.php');
    }

    public function showRegister() {
        $user = \App\Core\Session::get('user');
        if ($user) {
            if ($user['role'] === 'chef') {
                header("Location: " . url('/chef-dashboard'));
            } else {
                header("Location: " . url('/dashboard'));
            }
            exit;
        }
        $this->view('auth/register.php');
    }

    public function register() {
        checkCsrf();
        $name     = trim($_POST['name'] ?? '');
        $role     = $_POST['role'] ?? 'customer';
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::set('error', 'Invalid email address.');
            header("Location: " . url('/register'));
            exit;
        }

        if (strlen($password) < 6) {
            Session::set('error', 'Password must be at least 6 characters.');
            header("Location: " . url('/register'));
            exit;
        }

        if (User::findByEmail($email)) {
            Session::set('error', 'This email is already registered. Please login.');
            header("Location: " . url('/register'));
            exit;
        }

        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $userId = User::create($name, $role, $email, $hashed);

        if ($role === 'chef') {
            \App\Models\ChefProfile::create($userId);
        }

        Mailer::send($email, 'Welcome to ChefNextDoor', "Hello $name,\n\nThanks for joining ChefNextDoor!");

        Session::set('success', 'Account created! Please login.');
        header("Location: " . url('/login'));
        exit;
    }

    public function login() {
        checkCsrf();
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = User::findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            Session::set('user', [
                'id'    => $user['id'],
                'name'  => $user['name'],
                'email' => $user['email'],
                'role'  => $user['role']
            ]);

            if ($user['role'] === 'chef') {
                header("Location: " . url('/chef-dashboard'));
            } elseif ($user['role'] === 'customer') {
                header("Location: " . url('/dashboard'));
            } else {
                header("Location: " . url('/login'));
            }
            exit;
        }

        Session::set('error', 'Invalid email or password.');
        header("Location: " . url('/login'));
        exit;
    }

    public function logout() {
        Session::destroy();
        header("Location: " . url('/login'));
        exit;
    }
}
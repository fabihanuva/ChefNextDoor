<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Mailer;
use App\Models\User;

class AuthController extends Controller {

    public function showLogin() {
        $this->view('auth/login.php');
    }

    public function showRegister() {
        $this->view('auth/register.php');
    }

    public function register() {
        $name = trim($_POST['name'] ?? '');
        $role = $_POST['role'] ?? 'customer';
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        // Validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email address.";
            return;
        }

        if (strlen($password) < 6) {
            echo "Password must be at least 6 characters.";
            return;
        }

        // Hash password
        $hashed = password_hash($password, PASSWORD_BCRYPT);

        // Save user
        User::create($name, $role, $email, $hashed);

        // Send welcome email (optional)
        Mailer::send($email, 'Welcome to AuthBoard', "Hello $name,\n\nThanks for registering at AuthBoard.");

        // Redirect to login
        header("Location: /ChefNextDoor/public/login");
        exit;
    }

    public function login() {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = User::findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {

            // Store full user info INCLUDING role
            Session::set('user', [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ]);

            // Role-based redirect
            if ($user['role'] === 'chef') {
                header("Location: /ChefNextDoor/public/chef-dashboard");
            } elseif ($user['role'] === 'customer') {
                header("Location: /ChefNextDoor/public/dashboard");
            } else {
                header("Location: /ChefNextDoor/public/login");
            }

            exit;
        }

        echo 'Invalid credentials.';
    }

    public function logout() {
        Session::destroy();

        // IMPORTANT: do NOT use url('/login') here
        header("Location: /ChefNextDoor/public/login");
        exit;
    }
}
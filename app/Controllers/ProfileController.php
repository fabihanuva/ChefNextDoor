<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\User;
use App\Models\ChefProfile;

require_once __DIR__ . '/../../config/database.php';

class ProfileController extends Controller {

    public function show() {
        $user = requireAuth();
        $this->view('profile.php', ['user' => $user]);
    }

    public function update() {
        $user = requireAuth();
        $name = trim($_POST['name'] ?? '');

        if (!$name) {
            Session::set('error', 'Name cannot be empty.');
            header("Location: " . url('/profile'));
            exit;
        }

        $pdo  = \getDatabase();
        $stmt = $pdo->prepare('UPDATE users SET name = ? WHERE id = ?');
        $stmt->execute([$name, $user['id']]);

        $user['name'] = $name;
        Session::set('user', $user);

        Session::set('success', 'Profile updated successfully!');
        header("Location: " . url('/profile'));
        exit;
    }

    public function changePassword() {
        $user    = requireAuth();
        $current = $_POST['current_password'] ?? '';
        $new     = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if (!$current || !$new || !$confirm) {
            Session::set('error', 'All password fields are required.');
            header("Location: " . url('/profile'));
            exit;
        }

        if (strlen($new) < 6) {
            Session::set('error', 'New password must be at least 6 characters.');
            header("Location: " . url('/profile'));
            exit;
        }

        if ($new !== $confirm) {
            Session::set('error', 'New passwords do not match.');
            header("Location: " . url('/profile'));
            exit;
        }

        $pdo  = \getDatabase();
        $stmt = $pdo->prepare('SELECT password FROM users WHERE id = ?');
        $stmt->execute([$user['id']]);
        $row  = $stmt->fetch();

        if (!password_verify($current, $row['password'])) {
            Session::set('error', 'Current password is incorrect.');
            header("Location: " . url('/profile'));
            exit;
        }

        $hashed = password_hash($new, PASSWORD_BCRYPT);
        $stmt   = $pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
        $stmt->execute([$hashed, $user['id']]);

        Session::set('success', 'Password changed successfully!');
        header("Location: " . url('/profile'));
        exit;
    }

    public function chefProfile() {
        $user = requireAuth();
        if ($user['role'] !== 'chef') {
            header("Location: " . url('/dashboard'));
            exit;
        }

        $pdo     = \getDatabase();
        $stmt    = $pdo->prepare('SELECT * FROM chef_profiles WHERE user_id = ?');
        $stmt->execute([$user['id']]);
        $profile = $stmt->fetch();

        $this->view('chef/profile.php', ['user' => $user, 'profile' => $profile]);
    }

    public function updateChefProfile() {
        $user = requireAuth();
        if ($user['role'] !== 'chef') {
            header("Location: " . url('/dashboard'));
            exit;
        }

        $bio       = trim($_POST['bio'] ?? '');
        $specialty = trim($_POST['specialty'] ?? '');
        $location  = trim($_POST['location'] ?? '');

        $pdo  = \getDatabase();
        $stmt = $pdo->prepare('SELECT id FROM chef_profiles WHERE user_id = ?');
        $stmt->execute([$user['id']]);
        $exists = $stmt->fetch();

        if ($exists) {
            $stmt = $pdo->prepare('UPDATE chef_profiles SET bio = ?, specialty = ?, location = ? WHERE user_id = ?');
            $stmt->execute([$bio, $specialty, $location, $user['id']]);
        } else {
            $stmt = $pdo->prepare('INSERT INTO chef_profiles (user_id, bio, specialty, location) VALUES (?, ?, ?, ?)');
            $stmt->execute([$user['id'], $bio, $specialty, $location]);
        }

        Session::set('success', 'Chef profile updated!');
        header("Location: " . url('/chef/profile'));
        exit;
    }
}
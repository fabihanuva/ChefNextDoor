<?php
namespace App\Controllers;

use App\Core\Controller;

class SupportController extends Controller {

    public function about() {
        $this->view('support/about.php', ['title' => 'About Us | ChefNextDoor']);
    }

    public function help() {
        $this->view('support/help.php', ['title' => 'Help Center | ChefNextDoor']);
    }

    public function terms() {
        $this->view('support/terms.php', ['title' => 'Terms of Service | ChefNextDoor']);
    }

    public function privacy() {
        $this->view('support/privacy.php', ['title' => 'Privacy Policy | ChefNextDoor']);
    }
}

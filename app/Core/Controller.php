<?php
namespace App\Core;

/**
 * Controller — base class that all controllers extend.
 *
 * Provides the view() method so controllers can render HTML templates.
 * Each controller handles one area of the app (auth, dashboard, posts, etc.).
 */
abstract class Controller {
    /**
     * Render a view template.
     *
     * @param string $path  Path to the view file relative to app/Views/
     * @param array  $data  Variables to make available inside the template
     *
     * Example: $this->view('dashboard.php', ['user' => $user])
     *          This makes $user available inside app/Views/dashboard.php
     */
    protected function view(string $path, array $data = []): void {
        // extract() turns array keys into variables: ['user' => $u] creates $user
        extract($data);
        include __DIR__ . '/../Views/' . $path;
    }
}

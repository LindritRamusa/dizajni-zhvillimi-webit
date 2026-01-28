<?php

namespace App\Core;

abstract class Controller
{
    protected $viewsPath;

    public function __construct()
    {
        $this->viewsPath = dirname(__DIR__, 2) . '/views';
    }

    protected function render($view, array $data = [], $layout = 'public')
    {
        extract($data);
        if ($layout === 'admin') {
            require $this->viewsPath . '/layouts/admin-header.php';
            require $this->viewsPath . '/admin/' . $view . '.php';
            require $this->viewsPath . '/layouts/admin-footer.php';
        } else {
            require $this->viewsPath . '/layouts/header.php';
            require $this->viewsPath . '/pages/' . $view . '.php';
            require $this->viewsPath . '/layouts/footer.php';
        }
    }
}

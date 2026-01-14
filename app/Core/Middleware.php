<?php

namespace App\Core;

class Middleware
{
    public static function requireAuth()
    {
        $auth = new Auth();
        
        if (!$auth->isLoggedIn()) {
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
            header('Location: /login.php');
            exit;
        }
    }

    public static function requireAdmin()
    {
        $auth = new Auth();
        
        if (!$auth->isLoggedIn()) {
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
            header('Location: /login.php');
            exit;
        }

        if (!$auth->isAdmin()) {
            header('Location: /index.php');
            exit;
        }
    }

    public static function guestOnly()
    {
        $auth = new Auth();
        
        if ($auth->isLoggedIn()) {
            $user = $auth->getUser();
            
            if ($user['role'] === 'admin') {
                header('Location: /admin/dashboard.php');
            } else {
                header('Location: /index.php');
            }
            exit;
        }
    }
}

<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\Auth;
use App\Core\Database;

class DashboardController extends Controller
{
    public function index()
    {
        Middleware::requireAdmin();
        $auth = new Auth();
        $user = $auth->getUser();
        $db = Database::getInstance();

        $usersCount = $db->fetch("SELECT COUNT(*) as count FROM users")['count'];
        $servicesCount = $db->fetch("SELECT COUNT(*) as count FROM services")['count'];
        $newsCount = $db->fetch("SELECT COUNT(*) as count FROM news")['count'];
        $messagesCount = $db->fetch("SELECT COUNT(*) as count FROM contact_messages WHERE is_read = 0")['count'];

        $this->render('dashboard', [
            'pageTitle' => 'Dashboard',
            'pageDescription' => 'Paneli administrativ i Klinikës Medina',
            'currentPage' => 'dashboard',
            'user' => $user,
            'usersCount' => $usersCount,
            'servicesCount' => $servicesCount,
            'newsCount' => $newsCount,
            'messagesCount' => $messagesCount,
        ], 'admin');
    }
}

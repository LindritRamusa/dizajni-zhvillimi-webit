<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;
use App\Core\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        Middleware::requireAdmin();
        $auth = new Auth();
        $user = $auth->getUser();
        $userModel = new User();

        $users = $userModel->findAll();

        $this->render('users', [
            'pageTitle' => 'Përdoruesit',
            'pageDescription' => 'Menaxho përdoruesit e sistemit',
            'currentPage' => 'users',
            'user' => $user,
            'users' => $users,
        ], 'admin');
    }
}

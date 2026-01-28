<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Middleware;

class AuthController extends Controller
{
    private $auth;

    public function __construct()
    {
        parent::__construct();
        $this->auth = new Auth();
    }

    public function login()
    {
        Middleware::guestOnly();

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $result = $this->auth->login($email, $password);

            if ($result['success']) {
                header('Location: ' . $this->auth->getRedirectUrl());
                exit;
            }
            $error = $result['message'];
        }

        $this->render('login', [
            'pageTitle' => 'Hyrje - Klinika Medina',
            'pageDescription' => 'Hyni në llogarinë tuaj për të qasur shërbimet e Klinikës Medina',
            'currentPage' => 'login',
            'additionalScripts' => [],
            'error' => $error,
        ]);
    }

    public function register()
    {
        Middleware::guestOnly();

        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if ($password !== $confirmPassword) {
                $error = 'Fjalëkalimet nuk përputhen';
            } else {
                $result = $this->auth->register([
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'password' => $password,
                ]);

                if ($result['success']) {
                    header('Location: ' . $this->auth->getRedirectUrl());
                    exit;
                }
                $error = $result['message'];
            }
        }

        $this->render('register', [
            'pageTitle' => 'Regjistrohu - Klinika Medina',
            'pageDescription' => 'Regjistrohu për të qasur shërbimet e Klinikës Medina',
            'currentPage' => 'register',
            'additionalScripts' => ['/js/validation.js'],
            'error' => $error,
            'success' => $success,
            'name' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'phone' => $_POST['phone'] ?? '',
        ]);
    }

    public function logout()
    {
        $this->auth->logout();
        header('Location: /index.php');
        exit;
    }
}

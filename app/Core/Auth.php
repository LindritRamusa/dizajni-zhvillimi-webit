<?php

namespace App\Core;

use App\Models\User;

class Auth
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function register($data)
    {
        if ($this->user->emailExists($data['email'])) {
            return ['success' => false, 'message' => 'Email-i tashmë ekziston'];
        }

        if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
            return ['success' => false, 'message' => 'Të gjitha fushat janë të detyrueshme'];
        }

        if (strlen($data['password']) < 8) {
            return ['success' => false, 'message' => 'Fjalëkalimi duhet të ketë të paktën 8 karaktere'];
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Email nuk është i vlefshëm'];
        }

        $hashedPassword = $this->user->hashPassword($data['password']);
        
        $userData = [
            'name' => trim($data['name']),
            'email' => trim(strtolower($data['email'])),
            'phone' => $data['phone'] ?? null,
            'password' => $hashedPassword,
            'role' => 'user'
        ];

        try {
            $userId = $this->user->create($userData);
            
            if ($userId) {
                $loginResult = $this->login($data['email'], $data['password']);
                if ($loginResult['success']) {
                    return ['success' => true, 'message' => 'Regjistrimi u krye me sukses', 'role' => $loginResult['role']];
                }
            }
            
            return ['success' => false, 'message' => 'Gabim gjatë regjistrimit'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Gabim: ' . $e->getMessage()];
        }
    }

    public function login($email, $password)
    {
        if (empty($email) || empty($password)) {
            return ['success' => false, 'message' => 'Email dhe fjalëkalimi janë të detyrueshme'];
        }

        $user = $this->user->findByEmail(trim(strtolower($email)));

        if (!$user) {
            return ['success' => false, 'message' => 'Email ose fjalëkalim i gabuar'];
        }

        if (!$this->user->verifyPassword($password, $user['password'])) {
            return ['success' => false, 'message' => 'Email ose fjalëkalim i gabuar'];
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        return ['success' => true, 'message' => 'Hyrja u krye me sukses', 'role' => $user['role']];
    }

    public function logout()
    {
        $_SESSION = array();

        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }

        session_destroy();
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    public function isAdmin()
    {
        return $this->isLoggedIn() && isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    }

    public function isUser()
    {
        return $this->isLoggedIn() && isset($_SESSION['role']) && $_SESSION['role'] === 'user';
    }

    public function getUser()
    {
        if (!$this->isLoggedIn()) {
            return null;
        }

        return [
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'],
            'email' => $_SESSION['user_email'],
            'role' => $_SESSION['role']
        ];
    }

    public function requireLogin()
    {
        if (!$this->isLoggedIn()) {
            header('Location: /login.php');
            exit;
        }
    }

    public function requireAdmin()
    {
        if (!$this->isAdmin()) {
            header('Location: /index.php');
            exit;
        }
    }
}

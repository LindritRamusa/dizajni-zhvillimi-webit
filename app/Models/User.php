<?php

namespace App\Models;

use App\Core\Database;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        return $this->db->fetch($sql, ['email' => $email]);
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
        return $this->db->fetch($sql, ['id' => $id]);
    }

    public function create($data)
    {
        $sql = "INSERT INTO users (name, email, phone, password, role) 
                VALUES (:name, :email, :phone, :password, :role)";
        
        $params = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'password' => $data['password'],
            'role' => $data['role'] ?? 'user'
        ];

        $this->db->execute($sql, $params);
        return $this->db->lastInsertId();
    }

    public function emailExists($email)
    {
        $user = $this->findByEmail($email);
        return $user !== false;
    }

    public function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}

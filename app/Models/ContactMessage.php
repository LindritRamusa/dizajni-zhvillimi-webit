<?php

namespace App\Models;

class ContactMessage extends Model
{
    public function findAll()
    {
        $sql = "SELECT id, name, email, phone, subject, message, is_read, created_at 
                FROM contact_messages 
                ORDER BY created_at DESC";
        return $this->db->fetchAll($sql);
    }

    public function findById($id)
    {
        $sql = "SELECT id, name, email, phone, subject, message, is_read, created_at 
                FROM contact_messages 
                WHERE id = :id LIMIT 1";
        return $this->db->fetch($sql, ['id' => $id]);
    }

    public function create($data)
    {
        $sql = "INSERT INTO contact_messages (name, email, phone, subject, message) 
                VALUES (:name, :email, :phone, :subject, :message)";

        $params = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'subject' => $data['subject'] ?? null,
            'message' => $data['message']
        ];

        $this->db->execute($sql, $params);
        return $this->db->lastInsertId();
    }

    public function markAsRead($id)
    {
        $sql = "UPDATE contact_messages SET is_read = 1 WHERE id = :id";
        return $this->db->execute($sql, ['id' => $id]);
    }
}

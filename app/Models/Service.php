<?php

namespace App\Models;

use App\Core\Database;

class Service
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function findAll()
    {
        $sql = "SELECT s.*, u.name as creator_name 
                FROM services s 
                LEFT JOIN users u ON s.created_by = u.id 
                ORDER BY s.created_at DESC";
        return $this->db->fetchAll($sql);
    }

    public function findById($id)
    {
        $sql = "SELECT s.*, u.name as creator_name 
                FROM services s 
                LEFT JOIN users u ON s.created_by = u.id 
                WHERE s.id = :id LIMIT 1";
        return $this->db->fetch($sql, ['id' => $id]);
    }

    public function create($data)
    {
        $sql = "INSERT INTO services (title, subtitle, icon, description, duration, price, availability, image, created_by) 
                VALUES (:title, :subtitle, :icon, :description, :duration, :price, :availability, :image, :created_by)";
        
        $params = [
            'title' => $data['title'],
            'subtitle' => $data['subtitle'] ?? null,
            'icon' => $data['icon'] ?? null,
            'description' => $data['description'] ?? null,
            'duration' => $data['duration'] ?? null,
            'price' => $data['price'] ?? null,
            'availability' => $data['availability'] ?? null,
            'image' => $data['image'] ?? null,
            'created_by' => $data['created_by']
        ];

        $this->db->execute($sql, $params);
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE services 
                SET title = :title, subtitle = :subtitle, icon = :icon, description = :description, 
                    duration = :duration, price = :price, availability = :availability, 
                    image = :image, created_by = :created_by, updated_at = CURRENT_TIMESTAMP
                WHERE id = :id";
        
        $params = [
            'id' => $id,
            'title' => $data['title'],
            'subtitle' => $data['subtitle'] ?? null,
            'icon' => $data['icon'] ?? null,
            'description' => $data['description'] ?? null,
            'duration' => $data['duration'] ?? null,
            'price' => $data['price'] ?? null,
            'availability' => $data['availability'] ?? null,
            'image' => $data['image'] ?? null,
            'created_by' => $data['created_by']
        ];

        return $this->db->execute($sql, $params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM services WHERE id = :id";
        return $this->db->execute($sql, ['id' => $id]);
    }
}

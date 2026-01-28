<?php

namespace App\Models;

class PageContent extends Model
{
    public function findBySection($section)
    {
        $sql = "SELECT c.*, u.name as creator_name 
                FROM about_content c 
                LEFT JOIN users u ON c.created_by = u.id 
                WHERE c.section = :section 
                ORDER BY c.display_order ASC, c.id ASC";
        return $this->db->fetchAll($sql, ['section' => $section]);
    }

    public function findById($id)
    {
        $sql = "SELECT c.*, u.name as creator_name 
                FROM about_content c 
                LEFT JOIN users u ON c.created_by = u.id 
                WHERE c.id = :id LIMIT 1";
        return $this->db->fetch($sql, ['id' => $id]);
    }

    public function create($data)
    {
        $sql = "INSERT INTO about_content (section, title, content, image, display_order, created_by) 
                VALUES (:section, :title, :content, :image, :display_order, :created_by)";

        $params = [
            'section' => $data['section'],
            'title' => $data['title'] ?? null,
            'content' => $data['content'] ?? null,
            'image' => $data['image'] ?? null,
            'display_order' => (int)($data['display_order'] ?? 0),
            'created_by' => $data['created_by']
        ];

        $this->db->execute($sql, $params);
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE about_content 
                SET section = :section, title = :title, content = :content, image = :image, 
                    display_order = :display_order, created_by = :created_by, updated_at = CURRENT_TIMESTAMP
                WHERE id = :id";

        $params = [
            'id' => $id,
            'section' => $data['section'],
            'title' => $data['title'] ?? null,
            'content' => $data['content'] ?? null,
            'image' => $data['image'] ?? null,
            'display_order' => (int)($data['display_order'] ?? 0),
            'created_by' => $data['created_by']
        ];

        return $this->db->execute($sql, $params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM about_content WHERE id = :id";
        return $this->db->execute($sql, ['id' => $id]);
    }
}

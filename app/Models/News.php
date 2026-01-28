<?php

namespace App\Models;

class News extends Model
{
    public function findAll()
    {
        $sql = "SELECT n.*, u.name as author_name 
                FROM news n 
                LEFT JOIN users u ON n.created_by = u.id 
                ORDER BY n.created_at DESC";
        return $this->db->fetchAll($sql);
    }

    public function findById($id)
    {
        $sql = "SELECT n.*, u.name as author_name 
                FROM news n 
                LEFT JOIN users u ON n.created_by = u.id 
                WHERE n.id = :id LIMIT 1";
        return $this->db->fetch($sql, ['id' => $id]);
    }

    public function create($data)
    {
        $sql = "INSERT INTO news (title, content, image, pdf_document, created_by) 
                VALUES (:title, :content, :image, :pdf_document, :created_by)";

        $params = [
            'title' => $data['title'],
            'content' => $data['content'],
            'image' => $data['image'] ?? null,
            'pdf_document' => $data['pdf_document'] ?? null,
            'created_by' => $data['created_by']
        ];

        $this->db->execute($sql, $params);
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE news 
                SET title = :title, content = :content, image = :image, 
                    pdf_document = :pdf_document, created_by = :created_by, 
                    updated_at = CURRENT_TIMESTAMP
                WHERE id = :id";

        $params = [
            'id' => $id,
            'title' => $data['title'],
            'content' => $data['content'],
            'image' => $data['image'] ?? null,
            'pdf_document' => $data['pdf_document'] ?? null,
            'created_by' => $data['created_by']
        ];

        return $this->db->execute($sql, $params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM news WHERE id = :id";
        return $this->db->execute($sql, ['id' => $id]);
    }
}

<?php

class Post {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllPosts() {
        $stmt = $this->db->prepare("SELECT * FROM posts");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPostById($id) {
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addPost($content, $imagePath) {
        $stmt = $this->db->prepare("INSERT INTO posts (content, image) VALUES (?, ?)");
        return $stmt->execute([$content, $imagePath]);
    }

    public function updatePost($id, $content, $imagePath = null) {
        if ($imagePath) {
            $stmt = $this->db->prepare("UPDATE posts SET content = ?, image = ? WHERE id = ?");
            return $stmt->execute([$content, $imagePath, $id]);
        } else {
            $stmt = $this->db->prepare("UPDATE posts SET content = ? WHERE id = ?");
            return $stmt->execute([$content, $id]);
        }
    }

    public function deletePost($id) {
        $stmt = $this->db->prepare("DELETE FROM posts WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
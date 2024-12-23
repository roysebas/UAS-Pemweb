<?php

require_once __DIR__ . '/../models/Post.php';

class PostController {
    private $postModel;

    public function __construct($db) {
        $this->postModel = new Post($db);
    }

    public function index() {
        return $this->postModel->getAllPosts();
    }

    public function store($content, $imagePath) {
        return $this->postModel->addPost($content, $imagePath);
    }

    public function edit($id, $content, $imagePath = null) {
        return $this->postModel->updatePost($id, $content, $imagePath);
    }

    public function destroy($id) {
        return $this->postModel->deletePost($id);
    }

    public function getPostById($id) {
        return $this->postModel->getPostById($id);
    }
}
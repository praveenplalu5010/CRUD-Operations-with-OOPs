<?php
require_once 'classDatabase.php';

class Review {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addReview($blog_id, $user_id, $comment) {
        return $this->db->insert('reviews', [
            'blog_id' => $blog_id,
            'user_id' => $user_id,
            'comment' => $comment
        ]);
    }

    public function getReviewsByBlogId($blog_id) {
        return $this->db->read('reviews', ['blog_id' => $blog_id]);
    }
}
?>
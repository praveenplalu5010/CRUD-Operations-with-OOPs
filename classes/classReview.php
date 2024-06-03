<?php
    /*
    * File Name    : classReview.php
    * Description  : Class for managing the Review functionality of the Blogs.
    * Author       : Praveen Prabhakaran
    * Date         : 2024-06-03
    * Version      : 1.0
    */
    require_once 'classDatabase.php';

    class Review {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }
        //Function to add a Review
        public function addReview($blog_id, $user_id, $comment) {
            return $this->db->insert('reviews', [
                'blog_id' => $blog_id,
                'user_id' => $user_id,
                'comment' => $comment
            ]);
        }
        //Function to get the Review by Blog ID
        public function getReviewsByBlogId($blog_id) {
            return $this->db->read('reviews', ['blog_id' => $blog_id]);
        }
    }
?>
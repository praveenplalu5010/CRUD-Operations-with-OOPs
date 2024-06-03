<?php
require_once 'classDatabase.php';

class Blog {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }
    //Create Blog
    public function createBlog($title, $description, $user_id) {
        if ($this->db->blogTitleExists($title)) {
            return false; // Blog title already exists
        }
        
        return $this->db->insert('blogs', [
            'title' => $title,
            'description' => $description,
            'created_by' => $user_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
    //Get all Blogs
    public function getAllBlogs() {
        return $this->db->read('blogs');
    }
    //Update Blog
    public function updateBlog($id, $title, $description) {
        if ($this->db->blogTitleExistsForOtherBlog($title, $id)) {
            return false; // Blog title already exists for another Blog
        }
        $updateData = [
            'title' => $title,
            'description' => $description,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        return $this->db->update('blogs', $updateData, ['id' => $id]);
    }
    //Delete Blog
    public function deleteBlog($id) {
        return $this->db->delete('blogs', ['id' => $id]);
    }
    //Get Blog by ID
    public function getBlogById($id) {
        $blogs = $this->db->read('blogs', ['id' => $id]);
        return $blogs ? $blogs[0] : null;
    }
}
?>
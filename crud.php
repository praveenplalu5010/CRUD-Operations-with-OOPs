<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once 'classes/classBlog.php';
require_once 'classes/classReview.php';

$blog   = new Blog();
$review = new Review();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        
        if (!empty($title) && !empty($description)) {
            if ($blog->updateBlog($id, $title, $description)) {
                $_SESSION['success'] = "Blog updated successfully!";
            } else {
                $_SESSION['error'] = "Blog title already exists for another item. Please use a different name.";
            }
        } else {
            $_SESSION['error'] = "Please fill all fields.";
        }
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        if ($blog->deleteBlog($id)) {
            $_SESSION['success'] = "Blog deleted successfully!";
        } else {
            $_SESSION['error'] = "Failed to delete item.";
        }
    } elseif (isset($_POST['add_review'])) {
        $blog_id = $_POST['blog_id'];
        $comment = trim($_POST['comment']);
        if (!empty($comment)) {
            $review->addReview($blog_id, $_SESSION['user_id'], $comment);
        }
    }
    header('Location: list-blogs.php');
    exit;
}
?>

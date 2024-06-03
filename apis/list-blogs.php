<?php
    /*
     * File Name    : list-blogs.php
     * Description  : API endpoint for returning Blog data in JSON format.
     * Author       : Praveen Prabhakaran
     * Date         : 2024-06-03
     * Version      : 1.0
    */
    require_once '../classes/classBlog.php';
    require_once 'auth.php'; // Include the Auth class

    // Check if the request contains a valid API token
    $api_token = isset($_GET['api_token']) ? $_GET['api_token'] : null;

    // If authentication fails, return unauthorized status
    if (!$api_token || !Auth::isValidToken($api_token)) {
        http_response_code(401); // Unauthorized
        echo json_encode(array("message" => "Unauthorized access."));
        exit;
    }

    header('Content-Type: application/json');

    $blog = new Blog();
    $blogs = $blog->getAllBlogs();

    echo json_encode($blogs);
?>

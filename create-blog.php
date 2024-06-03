<?php
    /*
    * File Name    : create-blog.php
    * Description  : Page for the creation of Blog.
    * Author       : Praveen Prabhakaran
    * Date         : 2024-06-03
    * Version      : 1.0
    */
    session_start();
    //If session is not set, then redirect to Login page
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
    //Page Configurations
    $active_class   = 'active';
    $page_title     = 'Create Blog';

    //Including necessary files
    require_once 'includes/header.php';
    require_once 'classes/classUser.php';
    require_once 'classes/classBlog.php';

    //Get all the logged in User's details
    $user           = new User();
    $user_details   = $user->getUserById($_SESSION['user_id']);
    $user_id        = $user_details['id'];

    $blog = new Blog();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['create'])) {
            $title          = trim($_POST['title']);
            $description    = trim($_POST['description']);

            if (!empty($title) && !empty($description) && !empty($user_id)) {
                if ($blog->createBlog($title, $description, $user_id)) {
                    $_SESSION['success'] = 'Blog created successfully! Please <a href="list-blogs.php" class="alert-link">click here</a> to view all the Blogs';
                } else {
                    $_SESSION['error'] = 'Blog title already exists. Please use a different title.';
                }
            } else {
                $_SESSION['error'] = "Please fill all fields.";
            }
        }
    }    

    //Validation success message
    if (isset($_SESSION['success'])) {
        echo '<div class="container px-2 py-2">
                <div class="alert alert-success" role="alert">
                ' . $_SESSION['success'] . '
                </div>
            </div>';
        unset($_SESSION['success']);
        unset($_SESSION['error']);
    }
    //Validation failure message
    if (isset($_SESSION['error'])) {
        echo '<div class="container px-2 py-2">
                <div class="alert alert-danger" role="alert">
                ' . $_SESSION['error'] . '
                </div>
            </div>';
        unset($_SESSION['error']);
        unset($_SESSION['success']);
    }
?>

<div class="container px-4 py-3">
    <div class="row justify-content-md-center">
        <h2 class="pb-2 border-bottom">Create Blog</h2>
        <p>If you want to create a new Blog, please submit the form below.</p>
        <form id="create_blog_form" class= "needs-validation" action="create-blog.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="user_id" name="user_id" value="<?= $user_id; ?>" />
            <div class="col-md-6 mb-3">
                <label for="InputTitle" class="form-label">Title<span class="mandatory">*</span></label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="InputDescription" class="form-label">Description<span class="mandatory">*</span></label>
                <textarea id="description" name="description" class="form-control" placeholder="Description" required></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <button type="submit" id="create_blog_button" name="create" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>

<?php require_once 'includes/footer.php';?>
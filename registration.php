<?php
    /*
    * File Name    : registration.php
    * Description  : User registration page
    * Author       : Praveen Prabhakaran
    * Date         : 2024-06-03
    * Version      : 1.0
    */
    session_start();
    //Page Configurations
    $page_title     = 'Register';
    
    //Including necessary files
    require_once 'includes/header.php';
    require_once 'classes/classUser.php';

    //On form submit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
    
        if (!empty($name) && !empty($email) && !empty($password)) {
            $user = new User();
            if ($user->register($name, $email, $password)) {
                $_SESSION['success'] = 'User registered successfully! Please <a href="login.php" class="alert-link">login</a> to continue';
                //header('Location: login.php');
            } else {
                $_SESSION['error'] = "Email already exists. Please use a different email.";
            }
        } else {
            $_SESSION['error'] = "Please fill all the inputs";
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
<div class="container px-4 py-5">
    <div class="row justify-content-md-center">
        <!-- <div class="col-md-auto"> -->
            <h2 class="pb-2 border-bottom">Register</h2>
            <p>If you are not a member, please register now</p>
            <form id="register_form" class= "needs-validation" action="registration.php" method="POST">
                <div class="col-md-3 mb-3">
                    <label for="InputName" class="form-label">Full Name<span class="mandatory">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="InputEmail" class="form-label">Email address<span class="mandatory">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="InputPassword" class="form-label">Password<span class="mandatory">*</span></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                </div>
                <div class="col-md-3 mb-3">
                    <button type="submit" id="register_submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-md-3">
                    <p>Already have an account? <a class="link-opacity-100" href="login.php">Login now</a></p>
                </div>
            </form>
        <!-- </div> -->
    </div>
</div>

<?php require_once 'includes/footer.php';?>
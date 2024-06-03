<?php
    session_start();
    //Page Configurations
    $active_class   = 'active';
    $page_title     = 'Login';
    
    //Including necessary files
    require_once 'includes/header.php';
    require_once 'classes/classUser.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if (!empty($email) && !empty($password)) {
            $user = new User();
            $user_id = $user->login($email, $password);
            if ($user_id) {
                $_SESSION['user_id'] = $user_id;
                header('Location: profile.php');
                exit;
            } else {
                $_SESSION['error'] = "Invalid email or password.";
            }
        } else {
            $_SESSION['error'] = "Please fill all fields.";
        }
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

<div class="container px-2 py-5">
    <div class="row justify-content-md-center">
        <h2 class="pb-2 border-bottom">Login</h2>
        <p>Please login using your credentials</p>
        <form id="login_form" class= "needs-validation" action="login.php" method="POST">
            <div class="col-md-3 mb-3">
                <label for="InputEmail" class="form-label">Email address<span class="mandatory">*</span></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="InputPassword" class="form-label">Password<span class="mandatory">*</span></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
            </div>
            <div class="col-md-3 mb-3">
                <button id="login_submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-md-3 mb-3">
                <p>Not a member? <a class="link-opacity-100" href="registration.php">Sign up now</a></p>
            </div>
        </form>
    </div>
</div>

<?php require_once 'includes/footer.php';?>
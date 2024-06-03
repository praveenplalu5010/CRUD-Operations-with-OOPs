<?php
    session_start();
    //If session is not set, then redirect to Login page
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
    //Page Configurations
    $active_class   = 'active';
    $page_title     = 'My Profile';

    //Including necessary files
    require_once 'includes/header.php';
    require_once 'classes/classUser.php';

    //Get all the logged in User's details
    $user = new User();
    $userData = $user->getUserById($_SESSION['user_id']);

    //On submit of the Profile update form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);

        if (!empty($name) && !empty($email)) {
            if ($user->updateUser($_SESSION['user_id'], $name, $email)) {
                $_SESSION['success'] = "Profile updated successfully!";
                //header('Location: profile.php');
            } else {
                $_SESSION['error'] = "Email already exists for another user. Please use a different email.";
            }
        } else {
            $_SESSION['error'] = "Please fill all fields.";
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
        <!-- <div class="col-md-auto"> -->
            <h2 class="pb-2 border-bottom">My Profile</h2>
            <p>If you want to update your details, please proceed with the update.</p>
            <form id="user_profile_form" class= "needs-validation" action="profile.php" method="POST">
                <div class="col-md-3 mb-3">
                    <label for="InputName" class="form-label">Full Name<span class="mandatory">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name" value="<?php echo $userData['name']; ?>" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="InputEmail" class="form-label">Email address<span class="mandatory">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?php echo $userData['email']; ?>" required>
                </div>
                <div class="col-md-3 mb-3">
                    <button type="submit" id="user_profile_update" class="btn btn-primary">Update</button>
                </div>
            </form>
        <!-- </div> -->
    </div>
</div>

<?php require_once 'includes/footer.php';?>
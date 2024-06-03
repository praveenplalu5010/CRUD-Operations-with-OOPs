<?php
    /*
    * File Name    : list-users.php
    * Description  : Listing page of the Users
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
    $page_title     = 'List Users';

    //Including necessary files
    require_once 'includes/header.php';
    require_once 'classes/classUser.php';

    $user = new User();

    if (!$user->isAdmin($_SESSION['user_id'])) {
        echo "Access denied!";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_role'])) {
        $user_id = $_POST['user_id'];
        $role = $_POST['role'];

        if ($user->updateUserRole($user_id, $role)) {
            $_SESSION['success'] = "User role updated successfully!";
        } else {
            $_SESSION['error'] = "User role update failed";
        }
    }

    $users = $user->getAllUsers();

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

<?php if(!empty($user)){?>
<div class="container px-4 py-3">
    <h2 class="pb-2 border-bottom">All Users</h2>
    <div class="table-responsive">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $u): ?>
            <tr>
                <form action="list-users.php" method="POST">
                    <td><?php echo htmlspecialchars($u['name']); ?></td>
                    <td><?php echo htmlspecialchars($u['email']); ?></td>
                    <td>
                        <select name="role" class="form-control mb-2">
                            <option value="user" <?php if ($u['role'] == 'user') echo 'selected'; ?>>User</option>
                            <option value="admin" <?php if ($u['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                        </select>
                    </td>
                    <td>
                        <button type="submit" name="update_role"  class="btn btn-info btn-sm">Update Role</button>
                        <input type="hidden" name="user_id" value="<?php echo $u['id']; ?>">
                    </td>
                </form>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>

<?php require_once 'includes/footer.php';?>
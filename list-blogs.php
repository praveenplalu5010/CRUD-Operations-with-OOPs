<?php
    /*
    * File Name    : list-blogs.php
    * Description  : Listing page for the Blogs
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
    $page_title     = 'Blogs';

    //Including necessary files
    require_once 'includes/header.php';
    require_once 'classes/classUser.php';
    require_once 'classes/classBlog.php';
    require_once 'classes/classReview.php';

    //Get all the logged in User's details
    $user           = new User();
    $user_details   = $user->getUserById($_SESSION['user_id']);
    $user_id        = $user_details['id'];

    $blog           = new Blog();
    $blogs          = $blog->getAllBlogs();

    $review         = new Review();

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

<?php if(!empty($blogs)){?>
<div class="container px-4 py-3">
    <div class="cd-grid gap-2 d-md-flex justify-content-md-end">
        <a href="create-blog.php">
            <button type="button" class="btn btn-outline-info">Create Blog</button>
        </a>
    </div>
    <h2 class="pb-2 border-bottom">All Blogs</h2>
    <div class="table-responsive">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Reviews</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($blogs as $blog): ?>
                <tr>
                    <form action="crud.php" method="POST" enctype="multipart/form-data">
                        <td><?php echo htmlspecialchars($blog['title']); ?></td>
                        <td><?php echo htmlspecialchars($blog['description']); ?></td>
                        <td>
                            <?php
                            $reviews = $review->getReviewsByBlogId($blog['id']);
                            foreach ($reviews as $r) {
                                echo "<p>{$r['comment']} (User ID: {$r['user_id']})</p>";
                            }
                            ?>
                            <textarea name="comment" placeholder="Add a review" class="form-control mb-2"></textarea>
                            <button type="submit" name="add_review" class="btn btn-info btn-sm">Add Review</button>
                            <input type="hidden" name="blog_id" value="<?php echo $blog['id']; ?>">
                        </td>
                        <td><?php echo htmlspecialchars($blog['created_at']); ?></td>
                        <td><?php echo htmlspecialchars($blog['updated_at']); ?></td>
                        <td>
                            <?php if ($_SESSION['user_id'] == $blog['created_by']): ?>
                            
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($blog['id']); ?>">
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                <input type="text" name="title" id="title" class="form-control mb-2" value="<?php echo htmlspecialchars($blog['title']); ?>" required>
                                <textarea name="description"id="description" class="form-control mb-2" placeholder="Description" required><?php echo htmlspecialchars($blog['description']); ?></textarea>
                                <button type="submit" name="update" class="btn btn-info btn-sm">Update</button>
                                <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            
                            <?php else: ?>
                            No actions available
                            <?php endif; ?>
                        </td>
                    </form>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php } else{ ?>
    <div class="container px-4 py-3">
        <h2 class="pb-2 border-bottom">Blogs</h2>
        <div class="container px-2 py-2">
            <div class="alert alert-warning" role="alert">
            No Blogs Found! You can <a href="create-blog.php" class="alert-link">create</a> your first Blog
            </div>
        </div>
    </div>
<?php } ?>

<?php require_once 'includes/footer.php';?>
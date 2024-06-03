
<?php 
    $active_class = 'active';
?>
<?php require_once 'includes/header.php';?>

<div class="container px-4 py-5">
    <div class="row justify-content-md-center">
        <div class="col-md-auto">
            <h2 class="pb-2 border-bottom">Login</h2>
            <p>Please login using your credentials</p>
            <form>
                <div class="mb-3">
                    <label for="InputEmail1" class="form-label">Email address<span class="mandatory">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text" >@</span>
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                    </div>
                    
                    <!--<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>-->
                </div>
                <div class="mb-3">
                    <label for="InputPassword1" class="form-label">Password<span class="mandatory">*</span></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="mb-3">
                    <p><a class="link-opacity-100" href="registration.php">New user?</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php';?>
<?php 
    /*
    * File Name    : header.php
    * Description  : Header of the website.
    * Author       : Praveen Prabhakaran
    * Date         : 2024-06-03
    * Version      : 1.0
    */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= (!isset($page_title))? 'Kelsius - Portal': $page_title; ?></title>
    <!--CSS files-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="assets/images/kelsius_logo.png" alt="Logo" width="100" height="60" class="d-inline-block align-text-top">
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (!isset($_SESSION['user_id'])){ ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($active_class == '')? '': $active_class; ?>" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" <?= ($active_class == '')? '': $active_class; ?> href="registration.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" <?= ($active_class == '')? '': $active_class; ?> href="login.php">Login</a>
                        </li>
                    <?php } else{ ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($active_class == '')? '': $active_class; ?>" aria-current="page" href="profile.php">My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" <?= ($active_class == '')? '': $active_class; ?> href="list-blogs.php">Blogs</a>
                        </li>
                    <?php } ?>
                    <?php 
                        require_once 'classes/classUser.php';

                        $user = new User();
                        if(isset($_SESSION['user_id'])){
                            if ($user->isAdmin($_SESSION['user_id'])) {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" <?= ($active_class == '')? '': $active_class; ?> href="list-users.php">Users</a>
                            </li>
                        <?php
                            }
                        }
                    ?>
                </ul>
                <?php if (isset($_SESSION['user_id'])){ ?>
                <div class="d-flex">
                    <button id="logout_button" class="btn btn-outline-danger" type="submit">Logout</button>
                </div>
                <?php } ?>
            </div>
        </div>
    </nav>


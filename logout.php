<?php
    /*
    * File Name    : logout.php
    * Description  : Logout page
    * Author       : Praveen Prabhakaran
    * Date         : 2024-06-03
    * Version      : 1.0
    */
    session_start();
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
?>

<?php
    //Authorization - Access Control
    //check if user is logged in or not

    if(!isset($_SESSION['user'])){
        //user session is not set i.e. user is not logged in
        //redirect to login page
        $_SESSION['no-login-msg'] = "<div class='error text-center'>Please log in to access the Admin Panel</div>";
        //redirect to login page
        header('location:'.SITEURL.'admin/login.php');
    }
?>
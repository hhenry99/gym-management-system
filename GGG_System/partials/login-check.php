<?php
    //check wehtehr the user is logeed in or not
    if(!isset($_SESSION['user']))
    {
        $_SESSION['no-login-message'] = "<div class = 'error text-center'>Please login to access admin panel.</div>";
        //redirect to login page
        header('location:'.SITEURL.'login.php');
    }
?>
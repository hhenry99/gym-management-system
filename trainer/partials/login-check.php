<?php
include("function.php");

if(isset($_SESSION['user_id'])){
    $id = $_SESSION['user_id'];
} else {
    $_SESSION['no-login-message'] = "Please login to access trainer panel.";
    header('location:'.SITEURL.'admin/login.php');
    die();
}

?>
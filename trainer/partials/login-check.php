<?php
include("function.php");

if(isset($_SESSION['user_id'])){
    $id = $_SESSION['user_id'];
    if(checkTrainerLogin($conn, $id) == true){
        echo "ERROR!";
        die();
    }
} else {
    $_SESSION['no-login-message'] = "Please login to access admin panel.";
    header('location:'.SITEURL.'ggg_system/login.php');
    die();
}

?>
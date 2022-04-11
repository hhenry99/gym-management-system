<?php
include('../config/constant.php');
include('../partials/login-check.php');


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM registration WHERE regist_id = $id";
    $res = mysqli_query($conn, $sql);

    $_SESSION['delete'] = '<br>Registration Deleted!';
    header('location:'.SITEURL.'registration.php');
} else {
    header('location:'.SITEURL.'registration.php');
}



include('../config/close-connection.php');
?>
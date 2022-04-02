<?php

include('../config/constant.php');
include('../partials/login-check.php');

if(isset($_GET['id']) AND isset($_GET['image'])){
    $id = $_GET['id'];
    $image = $_GET['image'];

    $sql = "DELETE FROM user where user_id = $id";

    $res = mysqli_query($conn, $sql);

    if($res == true)
    {
        if($image != "")
        {
            $path = "../images/trainer/".$image;
            $remove = unlink($path);
        }

        $_SESSION['delete'] = "<br><span style = 'color: red; font-weight:bold;'>Delete Success!</span>";
        header('location:'.SITEURL.'manage-trainer.php');
    }
}
else
{
    header('location:'.SITEURL.'manage-trainer.php');
}

include('../config/close-connection.php');
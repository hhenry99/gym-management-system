<?php

include('../config/constant.php');
include('../partials/login-check.php');
include('../functions.php');

if(isset($_GET['id']) AND isset($_GET['image'])){
    $id = $_GET['id'];
    $image = $_GET['image'];

    if(checkTrainer($conn, $id) == true){
        $_SESSION['Foreign'] = "<br><span style = 'color: red; font-weight: bold'>Error ... Unable to delete Trainer.</span>";
        header('location:'.SITEURL.'manage-trainer.php');
        die();
    }

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

mysqli_close($conn);
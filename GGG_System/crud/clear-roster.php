<?php
include('../config/constant.php');
include('../partials/login-check.php');

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    
    $sql= "SELECT * FROM class WHERE class_id = $id";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if($count == 1)
    {
        $sql2 = "DELETE FROM registration WHERE class_class_id = $id";
        $re2 = mysqli_query($conn, $sql2);
        $_SESSION['delete'] = "<br><span style = 'color: red; font-weight: bold'>Class Roster Cleared!</span>";
        header("location:".SITEURL."crud/class-roster.php?id={$id}");
    }
    else
    {
        header('location:'.SITEURL.'manage-class.php');
    }
    
}
else
{
    header('location:'.SITEURL.'manage-class.php');
}

include('../config/close-connection.php');
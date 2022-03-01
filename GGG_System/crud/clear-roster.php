<?php
include('../config/constant.php');

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    
    $sql= "SELECT * FROM class WHERE class_id = $id";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if($count == 1)
    {
        $sql2 = "DELETE FROM member_has_class WHERE class_class_id = $id";
        $re2 = mysqli_query($conn, $sql2);
        $_SESSION['clear-roster'] = "Class Roster Cleared!";
        header("location:".SITEURL."crud/class-roster.php?id={$id}");
    }
    else
    {
        $_SESSION['no-id-found'] = "Error ... ID Not Found!";
        header('location:'.SITEURL.'manage-class.php');
    }
    
}
else
{
    $_SESSION['no-id-found'] = "Error ... ID Not Found!";
    header('location:'.SITEURL.'manage-class.php');
}

include('../config/close-connection.php');
<?php
include('../config/constant.php');

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $sql = "DELETE FROM class where class_id = $id";

    $res = mysqli_query($conn, $sql);

    if($res == true)
    {
        $_SESSION['delete-class'] = "Class Deleted Success!";
        header('location:'.SITEURL.'manage-class.php');
    }
}
else
{
    header('location:'.SITEURL.'manage-class.php');
}


include('../config/close-connection.php');
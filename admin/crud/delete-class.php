<?php
include('../config/constant.php');
include('../partials/login-check.php');
include('../functions.php');

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    if(checkMemberClass($conn, $id) == true){
        $_SESSION['Foreign'] = "<br><span style = 'color: red; font-weight: bold;'> Error ... Unable to Delete Class.</span>";
        header('location:'.SITEURL.'manage-class.php');
        die();
    }

    $sql = "DELETE FROM class where class_id = $id";
    $res = mysqli_query($conn, $sql);

    if($res == true)
    {
        $_SESSION['delete'] = "<br><span style = 'color: red; font-weight: bold'>Class Deleted Success!</span>";
        header('location:'.SITEURL.'manage-class.php');
    }
}
else
{
    header('location:'.SITEURL.'manage-class.php');
}


include('../config/close-connection.php');
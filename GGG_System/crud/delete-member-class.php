<?php 
include('../config/constant.php');
include('../partials/login-check.php');

if(isset($_GET['memberid']) AND isset($_GET['classid']))
{
    $memberid = $_GET['memberid'];
    $classid = $_GET['classid'];

    $sql = "DELETE FROM member_has_class WHERE member_member_id = $memberid AND class_class_id = $classid;";
    
    
    try{
        $res = mysqli_query($conn, $sql);
        $_SESSION['delete_member_class'] = "Member successfully remove from class";
        header("location:".SITEURL."crud/class-roster.php?id={$classid}");

    }
    catch(Exception $e)
    {
        echo "Error";
    }
}
else
{
    header('location:'.SITEURL.'manage-class.php');
}

include('../config/close-connection.php');

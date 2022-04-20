<?php
include('config/constant.php');
include('partials/login-check.php');

if(isset($_GET['memberid']) AND isset($_GET['classid']))
{
    $memberid = $_GET['memberid'];
    $classid = $_GET['classid'];

    $sql = "UPDATE registration SET
            class_status = 0
            WHERE user_user_id = $memberid AND class_class_id = $classid;";
    
    try{
        $res = mysqli_query($conn, $sql);
        $_SESSION['delete'] = "<br><span style = 'color: red; font-weight: bold'>Member Removed!</span>";
        header("location:".SITEURL."trainer/class.php?id={$classid}");

    }
    catch(Exception $e)
    {
        echo "Error";
    }
}
else
{
    header('location:'.SITEURL.'trainer/index.php');
}

include('config/close-connection.php');
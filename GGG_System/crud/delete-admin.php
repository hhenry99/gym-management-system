<?php
include('../config/constant.php');
include('../partials/login-check.php');

if(isset($_GET['uid']) AND isset($_GET['image_name']))
{
    $uid = $_GET['uid'];
    $image_name = $_GET['image_name'];

    $sql = "DELETE FROM user WHERE user_id = $uid;";

    $res = mysqli_query($conn, $sql);

    if($image_name != "")
    {
        //removing image
        $path = "../images/admin/".$image_name;
        $remove = unlink($path);
        if($remove == false)
        {
            $_SESSION['remove'] = "Fail to remove image";
            header('location:'.SITEURL.'manage-admin.php');
            die();
        }
    }
    
    $_SESSION['delete'] = "<p class = 'txt-green'>Admin successfully deleted!</p>";
    header('location:'.SITEURL.'manage-admin.php');

}
else
{
    header('location:'.SITEURL.'manage-admin.php');
}

include('../config/close-connection.php');
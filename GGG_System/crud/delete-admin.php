<?php
include('../config/constant.php');

if(isset($_GET['uid']) AND isset($_GET['aid']) AND isset($_GET['image_name']))
{
    $uid = $_GET['uid'];
    $aid = $_GET['aid'];
    $image_name = $_GET['image_name'];

    $sql = "DELETE FROM admin WHERE admin_id = $aid;";
    $sql2 = "DELETE FROM user WHERE user_id = $uid;";

    $res = mysqli_query($conn,$sql);
    $res = mysqli_query($conn,$sql2);

    if($image_name != "")
    {
        $path = "../images/admin/".$image_name;
        $remove = unlink($path);
        if($remove == false)
        {
            $_SESSION['remove'] = "fail to remove image";
            header('location:'.SITEURL.'manage-admin.php');
            die();
        }
    }
    
    $_SESSION['delete'] = "Admin successfully deleted!";
    header('location:'.SITEURL.'manage-admin.php');

}
else
{
    header('location:'.SITEURL.'manage-admin.php');
}

include('../config/close-connection.php');
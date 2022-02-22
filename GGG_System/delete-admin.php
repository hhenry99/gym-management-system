<?php
include('config/constant.php');

if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    $sql = "DELETE FROM admin WHERE admin_id = $id;";
    $res = mysqli_query($conn,$sql);

    if($res == true)
    {
        if($image_name != "")
        {
            $path = "images/admin/".$image_name;
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
        $_SESSION['delete'] = "Fail to delete admin";
        header('location:'.SITEURL.'manage-admin.php');
    }
}
else
{
    header('location:'.SITEURL.'manage-admin.php');
}

include('config/close-connection.php');
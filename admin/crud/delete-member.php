<?php
include('../config/constant.php');
include('../partials/login-check.php');

//Get method to get the id and image_name
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    $sql = "DELETE FROM user WHERE user_id = $id";
    $res = mysqli_query($conn,$sql);

    if($res==true)
    {
        if($image_name != "")
        {
            $path = "../images/member/".$image_name;
            $remove = unlink($path);

            if($remove == false)
            {
                $_SESSION['remove'] = "fail to remove image";
                header('location:'.SITEURL.'manage-member.php');
                die();
            }
        }
        $_SESSION['delete'] = "<br>Member Deleted!";
        header('location:'.SITEURL.'manage-member.php');
    }
    else
    {
        $_SESSION['delete'] = "Fail to delete member";
        header('location:'.SITEURL.'manage-member.php');
    }
}
else
{
    //redirect if id and image_name not pass
    header('location:'.SITEURL.'manage-member.php');
}


mysqli_close($conn);
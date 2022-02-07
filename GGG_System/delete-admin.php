<?php
include('config/constant.php');

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $sql = "SELECT admin_id FROM admin WHERE admin_id = $id;";

    $res = mysqli_query($conn,$sql);

    $count = mysqli_num_rows($res);

    if($count == 1)
    {
        $sql2 = "DELETE FROM admin WHERE admin_id = $id;";
        $res2 = mysqli_query($conn,$sql2);

        if($res2 == true)
        {
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

}
else
{
    header('location:'.SITEURL.'manage-admin.php');
}
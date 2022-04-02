<?php
include('../config/constant.php');
include('../partials/login-check.php');

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $sql = "SELECT * FROM equipment WHERE equipment_id = $id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if($count == 1)
    {
        $sql2 = "DELETE FROM equipment WHERE equipment_id = $id";
        $res2 = mysqli_query($conn, $sql2);

        $_SESSION['delete'] = "<br><span style ='color: red; font-weight:bold;'>Equipment deleted</span>";
        header('location:'.SITEURL.'manage-equipment.php');
    }
    else
    {
        header('location:'.SITEURL.'manage-equipment.php');
    }

    
}
else
{
    header('location:'.SITEURL.'manage-equipment.php');
}

include('../config/close-connection.php');

<?php
include('../config/constant.php');

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

        if($res2 == true)
        {
            $_SESSION['delete'] = "Equipment deleted";
            header('location:'.SITEURL.'manage-equipment.php');
        }
        else
        {
            $_SESSION['delete'] = "Fail to delete equipment";
            header('location:'.SITEURL.'manage-equipment.php');
        }
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

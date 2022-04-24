<?php
    include('../config/constant.php');
    include('../partials/login-check.php');

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];

        $sql = "SELECT * FROM plan WHERE plan_id = $id;";
        $res = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($res);

        if($count == 1){
            $sql2 = "DELETE FROM plan WHERE plan_id = $id;";
            $res2 = mysqli_query($conn, $sql2);

            $_SESSION['delete'] = "<br><span style ='color: red; font-weight:bold;'>Plan Deleted!</span>";
            header('location:'.SITEURL.'manage-plan.php');
        }
        else
        {
            header('location:'.SITEURL.'manage-plan.php');
        }

    }
    else
    {
        header('location:'.SITEURL.'manage-plan.php');
    }

mysqli_close($conn);

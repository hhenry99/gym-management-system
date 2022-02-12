<?php
    include('config/constant.php');

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];

        $sql = "SELECT * FROM plan WHERE plan_id = $id;";
        $res = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($res);

        if($count == 1){
            $sql2 = "DELETE FROM plan WHERE plan_id = $id;";
            $res2 = mysqli_query($conn, $sql2);

            if($res2==true)
            {
                $_SESSION['delete'] = "Plan deleted success";
                header('location:'.SITEURL.'manage-plan.php');

            }
            else
            {
                $_SESSION['delete'] = "Fail to delete plan";
                header('location:'.SITEURL.'manage-plan.php');
            }
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
?>


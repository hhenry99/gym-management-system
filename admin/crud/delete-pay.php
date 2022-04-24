<?php 
include('../config/constant.php');
include('../partials/login-check.php');

if(isset($_GET['payid']))
{
    $payid = $_GET['payid'];
    $sql = "SELECT payment_id FROM payment WHERE payment_id = $payid";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if($count == 1)
    {
        $sql2 = "DELETE FROM payment WHERE payment_id = $payid";
        $res2 = mysqli_query($conn, $sql2);

        $_SESSION['delete'] = "<br>Payment Delete Success!";
        header('location:'.SITEURL.'pay-history.php');  
    }
    else
    {
        header('location:'.SITEURL.'pay-history.php');  
    }

}
else
{
    header('location:'.SITEURL.'pay-history.php');
}

include('../config/close-connection.php');
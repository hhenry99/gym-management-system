<?php 
include('../config/constant.php');
include('../partials/login-check.php');

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    
    $sql = "SELECT invoice_id FROM invoice WHERE invoice_id = $id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if($count == 1)
    {
        $sql2 = "DELETE FROM invoice WHERE invoice_id = $id";
        
        $res2 = mysqli_query($conn, $sql2);
        $_SESSION['delete-invoice'] = "Invoice deleted Success!";
        header('location:'.SITEURL.'manage-invoice.php');
    }
    else
    {
        $_SESSION['no-id-found'] = "Error ... Invoice ID Not Found";
        header('location:'.SITEURL.'manage-invoice.php');
    }

}
else
{
    $_SESSION['no-id-found'] = "Error ... Invoice ID Not Found";
    header('location:'.SITEURL.'manage-invoice.php');
}


include('../config/close-connection.php');
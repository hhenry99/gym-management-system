<?php 
include('../config/constant.php');
include('../partials/login-check.php');
include('../functions.php');

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    
    $sql = "SELECT invoice_id FROM invoice WHERE invoice_id = $id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if($count == 1)
    {
        if(checkInvoicePay($conn, $id) == true){
            $_SESSION['Foreign'] = '<br><span style = "color: red; font-weight: bold">Error ... Unable to Delete Invoice</span>';
            header('location:'.SITEURL.'manage-invoice.php');
            die();
        }
        $sql2 = "DELETE FROM invoice WHERE invoice_id = $id";
        
        $res2 = mysqli_query($conn, $sql2);
        $_SESSION['delete'] = "<br><span style = 'color: red; font-weight: bold'>Invoice deleted Success!</span>";
        header('location:'.SITEURL.'manage-invoice.php');
    }
    else{
        header('location:'.SITEURL.'manage-invoice.php');
    }

}
else
{
    header('location:'.SITEURL.'manage-invoice.php');
}


include('../config/close-connection.php');
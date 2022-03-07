<?php 
include('../partials/crud-header.php');

if(isset($_GET['id'])){
    $invoice_id = $_GET['id'];
    $sql = "SELECT * FROM invoice WHERE invoice_id = $invoice_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if($count == 1)
    {
        $row = mysqli_fetch_assoc($res);
        $invoice_id = $row['invoice_id'];
        $invoice_amount = $row['amount'];
        $amount_paid = $row['amount_paid'];
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

?>

<?php
    if(isset($_POST['submit']))
    {
        $invoice_id = $_POST['invoiceid'];
        $cardnum = $_POST['cardnum'];
        $ccv = $_POST['ccv'];
        $expire = $_POST['expire'];
        $payment = $_POST['amount'];

        $sql2 = "INSERT INTO payment SET
                card_number = '$cardnum',
                card_ccv = '$ccv',
                card_expired = '$expire',
                payment_amount = $payment,
                payment_date = NOW(),
                invoice_invoice_id = $invoice_id;
                ";
        $res2 = mysqli_query($conn, $sql2);

        $sql3 = "UPDATE invoice SET 
                amount_paid = amount_paid + $payment
                WHERE invoice_id = $invoice_id;
                ";
        
        $res3 = mysqli_query($conn, $sql3);

        $_SESSION['add-pay'] = "Payment Added Success!";
        header('location:'.SITEURL.'manage-invoice.php');
    }
?>
<div class="main-content">
    <div class="header">
        <h1>Pay For Invoice <?php echo "#".$invoice_id;?></h1>
    </div>

    <div class="info">
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Invoice ID</td>
                    <td><input type="text" name = "invoiceid" value="<?php echo $invoice_id;?>" placeholder="Enter Invoice ID" required></td>
                </tr>
                <tr>
                    <td>Card Number</td>
                    <td><input type="text" name="cardnum" placeholder="Enter Card Number" maxlength="16" minlength="12" required></td>
                </tr>
                <tr>
                    <td>Card CCV</td>
                    <td><input type="text" name="ccv" placeholder="Enter Card CCV" required></td>
                </tr>
                <tr>
                    <td>Card Expiration</td>
                    <td><input type="text" name="expire" placeholder="Enter Card Expiration" maxlength="5" required></td>
                </tr>
                <tr>
                    <td>Payment Amount</td>
                    <td><input type="number" step=".01" name ="amount" placeholder = "Enter Amount" required></td>
                </tr>
                <tr>
                    <td colspan = "2"><input type="submit" name="submit" class ="btn-primary pad-1"></td>
                </tr>
            </table>
        </form>

        <div>
            <p>Invoice Amount: $<?php echo $invoice_amount;?></p>
            <p>Total Paid: $<?php echo $amount_paid;?></p>
            <p>Remaining: $<?php echo $invoice_amount - $amount_paid;?></p>
        </div>
    </div>
</div>


<?php include('../partials/crud-footer.php');?>
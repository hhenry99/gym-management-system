<?php
include('../partials/crud-header.php');
 
if(isset($_GET['id']))
{
    $invoice_id = $_GET['id'];
    $sql = "SELECT * FROM invoice WHERE invoice_id = $invoice_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if($count == 1)
    {
        $row = mysqli_fetch_assoc($res);
        $name = $row['name'];
        $amount = $row['amount'];
        $duedate = $row['due_date'];
        $member_id = $row['user_user_id'];

        //DATE TIME VALUE
        $t = $row['due_date'];
        date('Y-m-d\TH:i:s', strtotime($t));
    }
    else
    {
        header('location:'.SITEURL.'manage-invoice.php');
    }
}
else
{
    header('location:'.SITEURL.'manage-invoice.php');
}
 ?>

<?php

if(isset($_POST['submit']))
{
    $member_id = $_POST['memberid'];
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $duedate = $_POST['duedate'];
    $status = $_POST['status'];

    $sql2 = "UPDATE invoice SET
            user_user_id = $member_id,
            name = '$name',
            amount = $amount,
            due_date = '$duedate'
            WHERE invoice_id = $invoice_id;
            ";

    try{
        $res2 = mysqli_query($conn, $sql2);
        $_SESSION['update'] = "<br><span class = 'txt-green'>Invoice Updated!</span>";
        header('location:'.SITEURL.'manage-invoice.php');
    } catch (Exception $e){
        $_SESSION['member-not-found'] =  "<br><span class ='txt-red'>Error ... Member does not exist!</span>";
        header('location:'.SITEURL.'crud/add-invoice.php');
    }


}

?>

<div class="main-content">
    <div class="header txt-center">
        <h1>Update Invoice</h1>
        <p>
            <?php 
            if(isset($_SESSION['member-not-found'])){
                echo $_SESSION['member-not-found'];
                unset($_SESSION['member-not-found']);
            }
            ?>
        </p>
    </div>

    <div class="info">
        <form action="" method ="POST">
            <table class="tbl-wrapper">
                <tr>
                    <td>Member ID:</td>
                    <td><input type="text" name = "memberid" placeholder="Enter Member ID" value="<?php echo $member_id;?>"></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" placeholder="Invoice Name" value="<?php echo $name;?>"></td>
                </tr>
                <tr>
                    <td>Amount</td>
                    <td><input type="number" name="amount" step = ".01" placeholder="Enter Amount" value="<?php echo $amount;?>">
                </tr>
                <tr>
                    <td>Due Date</td>
                    <td><input type="datetime-local" name="duedate" value="<?php echo date('Y-m-d\TH:i:s', strtotime($t));?>"></td>
                </tr>
                <tr>
                    <td>
                        <br>
                        <input type="submit" value="Submit" name = "submit" class = "btn-second">
                    </td>
                    <td>
                        <br>
                        <input type="button" value="Cancel" class = 'btn-cancel' onClick="document.location.href='<?php echo SITEURL;?>manage-invoice.php';">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('../partials/crud-footer.php');?>


<?php include('../partials/crud-header.php');?>

<?php 
    if(isset($_POST['submit']))
    {
        $id = $_POST['memberid'];
        $name = $_POST['name'];
        $amount = $_POST['amount'];
        $duedate = $_POST['duedate'];

        $sql = "INSERT INTO invoice SET
                name = '$name',
                amount = '$amount',
                date_created = NOW(),
                due_date = '$duedate',
                member_member_id = $id;
                ";

        try{
            $res = mysqli_query($conn, $sql);
            $_SESSION['add-invoice'] = "Invoice Successfully Updated!";
            header('location:'.SITEURL.'manage-invoice.php');
        }
        catch(Exception $e)
        {
            echo "Member does not Exist Error! Please try again!";
        }
    }
?>
<div class="main-content">
    <div class="header">
        <h1>Add Invoice</h1>
    </div>

    <div class="info">
        <form action="" method ="POST">
            <table class="tbl-30">
                <tr>
                    <td>Member ID:</td>
                    <td><input type="text" name = "memberid" placeholder="Enter Member ID"></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" placeholder="Invoice Name"></td>
                </tr>
                <tr>
                    <td>Amount</td>
                    <td><input type="number" name="amount" step = ".01" placeholder="Enter Amount">
                </tr>
                <tr>
                    <td>Due Date</td>
                    <td><input type="datetime-local" name="duedate"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="submit" name = "submit" class = "btn-primary pad-1">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('../partials/crud-footer.php');?>
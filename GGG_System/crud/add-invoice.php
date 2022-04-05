<?php include('../partials/crud-header.php');?>

<div class="main-content">
    <div class="header txt-center">
        <h1>Add Invoice</h1>
        <p>
            <?php
            if(isset($_SESSION['member-not-found'])){
                echo $_SESSION['member-not-found'];
                unset($_SESSION['member-not-found']);
            }
            ?>

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
                            user_user_id = $id;
                            ";

                    try{
                        $res = mysqli_query($conn, $sql);
                        $_SESSION['add'] = "<br><span class = 'txt-green'>Invoice Successfully Added!</span>";
                        header('location:'.SITEURL.'manage-invoice.php');
                    }
                    catch(Exception $e)
                    {
                        $_SESSION['member-not-found'] =  "<br><span class ='txt-red'>Error ... Member does not exist!</span>";
                        header('location:'.SITEURL.'crud/add-invoice.php');
                    }
                }
            ?>
        </p>
    </div>

    <div class="info">
        <form action="" method ="POST">
            <table class="tbl-wrapper">
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
                        <br>
                        <input type="submit" value="+Invoice" name = "submit" class = "btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('../partials/crud-footer.php');?>
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
                    <td>
                        <input list = 'member' type = 'text' name = 'memberid' placeholder = 'ENTER ID OR SELECT'required>
                        <datalist id = 'member'>
                            <?php
                            $sql = "SELECT user_id, name, email FROM user WHERE role = 1";
                            $res = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($res) > 0){
                                while($row = mysqli_fetch_assoc($res)){
                                    $user_id = $row['user_id'];
                                    $name = $row['name'];
                                    $email = $row['email'];
                                    ?>
                                    <option value="<?php echo $user_id?>"><?php echo $name;?> | <?php echo $email;?></option>
                                    <?php
                                }
                            }
                            ?>
                        </datalist>
                    </td>
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
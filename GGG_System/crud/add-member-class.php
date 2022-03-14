<?php include('../partials/crud-header.php');?>

<?php 
if(isset($_GET['id']))
{
    $id = $_GET['id'];
}
else
{
    $id = "";
}
?>


<div class="main-content">
    <div class="header">
        <h1>Add Member To Class</h1>
        <p>
            <?php 
                include('../partials/session_check.php');
            ?>

            <?php 
            if(isset($_POST['submit']))
            {
                $classid = $_POST['class_id'];

                //getting data from class
                $sql2 = "SELECT name, cost FROM class where class_id = $classid";
                $res2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($res2);
                $name = $row2['name'];
                $cost = $row2['cost'];

                $memberid = $_POST['member_id'];

                //SQL to insert into member has class table
                $sql3 = "INSERT INTO member_has_class SET
                        member_member_id = $memberid,
                        class_class_id =  $classid;
                        ";
                
                //SQL to insert into invoice
                $sql4 = "INSERT INTO invoice SET
                name = 'Invoice for $name Class',
                amount = $cost,
                date_created = NOW(),
                due_date = DATE_ADD(NOW(), INTERVAL 1 MONTH),
                member_member_id = $memberid;
                ";
                try{
                    $res3 = mysqli_query($conn, $sql3);
                    
                    $res4 = mysqli_query($conn, $sql4);
                    
                    $_SESSION['member-added'] = "Member Added Success!";
                    header("location:".SITEURL."crud/class-roster.php?id={$classid}");
                }
                catch (Exception $exception){
                    $_SESSION['member-not-found'] = "Member not found or already in the class, please try again";
                    header('location:'.SITEURL.'crud/add-member-class.php');
                }
            }
            ?>
        </p>
    </div>

    <div class="info">
        <form action="" method = "POST">
            <table class="tbl-30">
                <tr>
                    <td>Class</td>
                    <td>
                        <select name="class_id">
                            <?php
                                //select from class table and display the results in a select list
                                $sql = "SELECT * FROM class";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);

                                if($count > 0)
                                {
                                    while($row = mysqli_fetch_assoc($res)){
                                        $class_name = $row['name'];
                                        $class_id = $row['class_id'];
                                        ?>
                                            <option value="<?php echo $class_id;?>" <?php if($class_id == $id){echo "selected";}?>>
                                                <?php echo $class_name;?>
                                            </option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                        <option value="">Please Add A Class</option>
                                    <?php
                                }
                            ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Member ID</td>
                    <td>
                        <input type="number" name = "member_id" step = "1" placeholder = "Enter Member ID" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Submit" name="submit" class="btn-primary pad-1">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('../partials/crud-footer.php');?>
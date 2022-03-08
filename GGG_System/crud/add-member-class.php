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
                $class = $_POST['class'];
                $member = $_POST['member_id'];

                $sql2 = "INSERT INTO member_has_class SET
                        member_member_id = $member,
                        class_class_id =  $class;
                        ";

                try{
                    $res2 = mysqli_query($conn, $sql2);
                    $_SESSION['member-added'] = "Member Added Success!";

                    // $sql3 = "INSERT INTO invoice SET
                    // name = 'Invoice for $name Class',
                    // amount = $cost,
                    // date_created = NOW(),
                    // due_date = DATE_ADD(NOW(), INTERVAL 1 MONTH);
                    // ";
                    // $res3 = mysqli_query($conn, $sql3);
                    
                    header("location:".SITEURL."crud/class-roster.php?id={$class}");
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
                        <select name="class">
                            <?php
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
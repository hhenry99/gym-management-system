<?php 

include('../partials/crud-header.php');
include('../functions.php');

?>

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
    <div class="header txt-center">
        <h1>Add Member to Class</h1>
        <p>
            <?php 
                if(isset($_SESSION['member-not-found'])){
                    echo $_SESSION['member-not-found'];
                    unset($_SESSION['member-not-found']);
                }
                if(isset($_SESSION['mac'])){
                    echo $_SESSION['mac'];
                    unset($_SESSION['mac']);
                }
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

                if(checkClass($conn, $classid, $memberid) == true){
                    // echo "Member is already in the class";
                    $_SESSION['mac'] = "Member already in class";
                    header('location:'.SITEURL.'crud/add-member-class.php');
                    die();

                }

                //SQL to insert into member has class table
                $sql3 = "INSERT INTO registration SET
                        user_user_id = $memberid,
                        class_class_id =  $classid;
                        ";
                
                //SQL to insert into invoice
                $sql4 = "INSERT INTO invoice SET
                name = 'Invoice for $name Class',
                amount = $cost,
                date_created = NOW(),
                due_date = DATE_ADD(NOW(), INTERVAL 1 MONTH),
                user_user_id = $memberid;
                ";

                try{
                    $res3 = mysqli_query($conn, $sql3);
                    $res4 = mysqli_query($conn, $sql4);
                    
                    $_SESSION['add'] = "<br><span class = 'txt-green'>Member Added Success!</span>";
                    header("location:".SITEURL."crud/class-roster.php?id={$classid}");
                }
                catch (Exception $exception){
                    $_SESSION['member-not-found'] = "<br><span class = 'txt-red'>Member Not Found</span>";
                    header('location:'.SITEURL.'crud/add-member-class.php');
                    die();
                }
            }
            ?>
        </p>
    </div>

    <div class="info">
        <form action="" method = "POST">
            <table class="tbl-wrapper">
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
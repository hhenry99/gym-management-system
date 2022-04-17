<?php
include('partials/header.php');

if(isset($_GET['id'])){
    $classid = $_GET['id'];
    $sql = "SELECT class_id from class WHERE class_id = $classid";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) == 0) {
        header('location:'.SITEURL.'trainer/class.php');
    }
} else {
    header('location:'.SITEURL.'trainer/class.php');
}
?>

<div class="main-content">
    <div class="header txt-center">
        <h1>Add Member</h1>
        <p>
            <?php 
                if(isset($_SESSION['member-not-found'])){
                    echo $_SESSION['member-not-found'];
                    unset($_SESSION['member-not-found']);
                }
                if(isset($_SESSION['member-in-class'])){
                    echo $_SESSION['member-in-class'];
                    unset($_SESSION['member-in-class']);
                }
            ?>

            <?php 
            if(isset($_POST['submit']))
            {
                $classid = $_POST['class_id'];
                $duedate = $_POST['duedate'];

                //getting data from class
                $sql2 = "SELECT name, cost FROM class where class_id = $classid";
                $res2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($res2);
                $name = $row2['name'];
                $cost = $row2['cost'];

                $memberid = $_POST['member_id'];

                if(checkClass($conn, $classid, $memberid) == true){
                    $_SESSION['member-in-class'] = "Member already in class";
                    header("location:".SITEURL."trainer/add-member.php?id={$classid}");
                    die();
                }

                //SQL to insert into member has class table
                $sql3 = "INSERT INTO registration SET
                        user_user_id = $memberid,
                        class_class_id =  $classid,
                        class_status = 1;
                        ";
                
                //SQL to insert into invoice
                $sql4 = "INSERT INTO invoice SET
                        name = 'Invoice for $name Class',
                        amount = $cost,
                        date_created = NOW(),
                        due_date = '$duedate',
                        user_user_id = $memberid;
                        ";

                $sql5 = "UPDATE user SET 
                        status = 1 
                        WHERE user_id = $memberid;";

                try{
                    $res3 = mysqli_query($conn, $sql3);
                    $res4 = mysqli_query($conn, $sql4);
                    $res5 = mysqli_query($conn, $sql5);

                    $_SESSION['add'] = "<br><span class = 'txt-green'>Member Added Success!</span>";
                    header("location:".SITEURL."trainer/class.php?id={$classid}");
                }
                catch (Exception $exception){
                    $_SESSION['member-not-found'] = "<br><span class = 'txt-red'>Member Not Found</span>";
                    header("location:".SITEURL."trainer/add-member.php?id={$classid}");
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
                                $sql = "SELECT class_id, name FROM class WHERE class_id = $classid";
                                $res = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($res);
                                $class_name = $row['name'];
                                $class_id = $row['class_id'];
                                ?>
                                <option value="<?php echo $class_id;?>">
                                    <?php echo $class_name;?>
                                </option>
                        </select>

                    </td>
                </tr>
                <tr>
                    <td>Member ID*</td>
                    <td>
                        <input list = 'member' type = 'text' name = 'member_id' placeholder = 'ENTER ID OR SELECT'required>
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
                    <td>Due Date*</td>
                    <td><input type="datetime-local" name="duedate" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <input type="submit" value="Submit" name="submit" class="btn-primary pad-1">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
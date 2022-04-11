<?php 
include('../partials/crud-header.php');
include('../functions.php');
?>

<?php
    if(isset($_POST['submit'])){
        $member_id = $_POST['member'];
        $plan_id = $_POST['plan'];
        $class_id = $_POST['class'];
        $due = $_POST['duedate'];

        
        if($plan_id == 'NULL' && $class_id == 'NULL'){
            $_SESSION['error'] = "<br><p class = 'txt-center'>Please select a plan or class</p>";
            header('location:'.SITEURL.'crud/add-regist.php');
            die();
        }

        if($plan_id != 'NULL'){
            if(checkPlan($conn, $member_id, $plan_id) == true){
                $_SESSION['error'] = "<br><p class = 'txt-center'>Member already has a plan</p>";
                header('location:'.SITEURL.'crud/add-regist.php');
                die();
            }
            $sql = "SELECT name, duration, cost FROM plan where plan_id = $plan_id";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);
            $plan_name = $row['name'];
            $plan_duration = $row['duration'];
            $plan_cost = $row['cost'];
        }

        if($class_id != 'NULL'){
            if(checkClass($conn, $class_id, $member_id) == true){
                $_SESSION['error'] = "<br><p class = 'txt-center'>Member is already in the class</p>";
                header('location:'.SITEURL.'crud/add-regist.php');
                die();
            }
            $sql = "SELECT name, cost FROM class where class_id = $class_id";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);
            $class_name = $row['name'];
            $class_cost = $row['cost'];
        }

        //BOTH SELECTED
        if($plan_id != 'NULL' && $class_id != 'NULL'){
            $sql = "INSERT INTO registration SET
                    plan_start = NOW(),
                    plan_expired = DATE_ADD(NOW(), INTERVAL $plan_duration MONTH),
                    plan_plan_id = $plan_id,
                    class_class_id = $class_id,
                    class_status = 1,
                    user_user_id = $member_id;
                    ";

            $res = mysqli_query($conn, $sql);

            $sql = "INSERT INTO invoice SET
                    name = 'Invoice for $plan_name Plan and $class_name Class',
                    amount = $plan_cost + $class_cost,
                    date_created = NOW(),
                    due_date = '$due',
                    user_user_id = $member_id;
                    ";
            
            $res = mysqli_query($conn, $sql);

            $sql = "UPDATE user SET 
                    status = 1 
                    WHERE user_id = $member_id;";
            
            $res = mysqli_query($conn, $sql);

            $_SESSION['add'] = "<br><span class = 'txt-green'>Registration added!</span>";
            header('location:'.SITEURL.'registration.php');
        } else{
            if($plan_id != 'NULL'){ //Only PLAN is selected
                $sql = "INSERT INTO registration SET 
                        plan_start = NOW(),
                        plan_expired = DATE_ADD(NOW(), INTERVAL $plan_duration MONTH),
                        plan_plan_id = $plan_id,
                        user_user_id = $member_id;
                        ";
                $res = mysqli_query($conn, $sql);

                $sql = "INSERT INTO invoice SET
                        name = 'Invoice for $plan_name Plan',
                        amount = $plan_cost,
                        date_created = NOW(),
                        due_date = '$due',
                        user_user_id = $member_id;
                        ";
                $res = mysqli_query($conn, $sql);

                $sql = "UPDATE user SET 
                status = 1 
                WHERE user_id = $member_id;";
        
                $res = mysqli_query($conn, $sql);

                $_SESSION['add'] = "<br><span class = 'txt-green'>Registration added!</span>";
                header('location:'.SITEURL.'registration.php');
                
            } else { // Only CLASS is selected
                $sql = "INSERT INTO registration SET
                        class_class_id = $class_id,
                        user_user_id = $member_id,
                        class_status = 1;
                        ";
                $res = mysqli_query($conn, $sql);

                $sql = "INSERT INTO invoice SET
                        name = 'Invoice for $class_name Class',
                        amount = $class_cost,
                        date_created = NOW(),
                        due_date = '$due',
                        user_user_id = $member_id;
                        ";

                $res = mysqli_query($conn, $sql);

                $sql = "UPDATE user SET 
                status = 1 
                WHERE user_id = $member_id;";
        
                $res = mysqli_query($conn, $sql);

                $_SESSION['add'] = "<br><span class = 'txt-green'>Registration added!</span>";
                header('location:'.SITEURL.'registration.php');
                die();
            }
        }

    }
?>

<div class="main-content">
    <div class="header txt-center">
        <h1>Register for Plan/Class</h1>
    </div>

    <div class="info">
        <p class = 'txt-red txt-center'>Attention! Choose either a plan, class or BOTH!</p>
        <br>
        <form action="" method="post">
            <table class = 'tbl-wrapper'>
                <tr>
                    <td>Select Member*</td>
                    <td>
                        <input list = 'member' type = 'text' name = 'member' placeholder = 'ENTER ID OR SELECT'required>

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
                    <td>Select Plan*</td>
                    <td>
                        <select name="plan">
                            <option value="NULL">None</option>
                            <?php
                            $sql2 = "SELECT plan_id, name FROM plan";
                            $res2 = mysqli_query($conn,$sql2);
                            if(mysqli_num_rows($res2) > 0){
                                while($row2 = mysqli_fetch_assoc($res2)){
                                    $plan_id = $row2['plan_id'];
                                    $plan_name = $row2['name'];
                                    ?>
                                    <option value="<?php echo $plan_id?>"><?php echo $plan_name;?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>

                    </td>
                </tr>
                <tr>
                    <td>Select Class*</td>
                    <td>
                        <select name="class" id="">
                            <option value="NULL">None</option>
                            <?php
                                $sql3 = "SELECT class_id, name FROM class";
                                $res3 = mysqli_query($conn,$sql3);
                                if(mysqli_num_rows($res3) > 0){
                                    while($row3 = mysqli_fetch_assoc($res3)){
                                        $class_id = $row3['class_id'];
                                        $class_name = $row3['name'];
                                        ?>
                                        <option value="<?php echo $class_id?>"><?php echo $class_name;?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>

                    </td>
                </tr>
                <tr>
                    <td>Due Date</td>
                    <td><input type="datetime-local" name="duedate" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <input type="submit" value="register" name ='submit'class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_SESSION['error'])){
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
        ?>
    </div>
</div>
<?php include('../partials/crud-footer.php');?>

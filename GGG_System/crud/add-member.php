<?php include('../partials/crud-header.php');?>

<div class="main-content">
    <div class="header txt-center">
        <h1>Add Member</h1>
        <p>
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>
        </p>
    </div>

    <div class="info">
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-wrapper">
                <tr>
                    <td>Image</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name = "name" required></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email" required></td>
                </tr>
                <tr>
                    <td>Phone #</td>
                    <td><input type="number" name = "phone" required></td>
                </tr>
                <tr>
                    <td>Emergency #</td>
                    <td><input type="number" name="emergency" required></td>
                </tr>
                <tr>
                    <td>Plan</td>
                    <td>
                        <select name="plan">
                            <?php 
                            //select from plan table and display the plans in a selection
                            $sql = "SELECT * FROM plan";
                            $res = mysqli_query($conn,$sql);
                            
                            $count = mysqli_num_rows($res);

                            if($count > 0)
                            {
                                while($row = mysqli_fetch_assoc($res))
                                {
                                    $id = $row['plan_id'];
                                    $name = $row['name'];
                                    ?>
                                        <option value="<?php echo $id;?>"><?php echo $name;?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan = "2">
                            <input type="submit" value="Add Member" class = "btn-primary" name = "submit">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit']))
            {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $emergency = $_POST['emergency'];
                $plan_id = $_POST['plan'];
                $status = $_POST['status'];

                //if image is selected
                if(!empty($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/member/".$image_name;

                    //upload image, if it fails, process dies
                    $upload = move_uploaded_file($source_path, $destination_path);

                    if($upload == false)
                    {
                        $_SESSION['upload'] = "Fail to upload img";
                        header('location:'.SITEURL.'add-member.php');
                        die();
                    }
                }
                else
                {
                    $image_name = "";
                }

                if($plan_id != "1"){
                    //Get data from member plan if plan is not "None"
                    $sql = "SELECT name, duration, cost FROM plan WHERE plan_id = $plan_id";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($res);
                    $plan_name = $row['name'];
                    $plan_cost = $row['cost'];
                    $plan_duration = $row['duration'];

                    //SQL to insert into member
                    $sql = "INSERT INTO member SET
                    image_name = '$image_name',
                    name = '$name',
                    email = '$email',
                    phone = '$phone',
                    emergency_contact = '$emergency',
                    date_join = NOW(),
                    date_expired = DATE_ADD(NOW(), INTERVAL $plan_duration MONTH),
                    member_status = '$status',
                    plan_plan_id = $plan_id
                    ";

                    $res = mysqli_query($conn, $sql);

                    //Insert invoice for new member
                    $sql = "INSERT INTO invoice SET
                    name = 'Invoice for $plan_name Plan',
                    amount = $plan_cost,
                    date_created = NOW(),
                    due_date = DATE_ADD(NOW(), INTERVAL 1 MONTH),
                    member_member_id = 
                    (SELECT member_id FROM member
                    order by 1 desc
                    limit 1);
                    ";
                    $res = mysqli_query($conn, $sql);
                } else{
                    //SQL to insert into member
                    $sql = "INSERT INTO member SET
                    image_name = '$image_name',
                    name = '$name',
                    email = '$email',
                    phone = '$phone',
                    emergency_contact = '$emergency',
                    date_join = NOW(),
                    member_status = '$status',
                    plan_plan_id = $plan_id
                    ";
                    $res = mysqli_query($conn, $sql);
                }

                if($res == true)
                {
                    $_SESSION['add'] = "Member added";
                    header('location:'.SITEURL.'manage-member.php');
                }
                    
            }
        ?>
    </div>
</div>
<?php include('../partials/crud-footer.php');?>
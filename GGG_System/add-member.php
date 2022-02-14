<?php include('partials/header.php');?>

<div class="main-content">
    <div class="header">
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

    <!-- <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Emergency Contact</th>
                        <th>Join Date</th>
                        <th>Plan</th>
                        <th>Status</th>
                        <th>Actions</th> -->
    <div class="info">
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Image</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name = "name"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email"></td>
                </tr>
                <tr>
                    <td>Phone #</td>
                    <td><input type="number" name = "phone"></td>
                </tr>
                <tr>
                    <td>Emergency #</td>
                    <td><input type="number" name="emergency"></td>
                </tr>
                <tr>
                    <td>Plan</td>
                    <td>
                        <select name="plan">
                            <?php 
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
                            else
                            {
                                ?>
                                    <option value="1">None</option>
                                <?php
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

                if(!empty($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "images/member/".$image_name;

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

                if($res == true)
                {
                    $_SESSION['add'] = "Member added";
                    header('location:'.SITEURL.'manage-member.php');
                }
                else
                {
                    $_SESSION['add'] = "Fail to add member";
                    header('location:'.SITEURL.'add-member.php');
                }
                    
            }
        ?>
    </div>
</div>
<?php include('partials/footer.php');?>
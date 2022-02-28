<?php require_once('../partials/crud-header.php');?>

<?php
    //ID must be pass 
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        
        $sql = "SELECT * FROM member WHERE member_id = $id";
        $res = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($res);

        //if the id is in the database
        if($count == 1)
        {
            //get data
            $row = mysqli_fetch_assoc($res);
            $current_image = $row['image_name'];                
            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $emergency = $row['emergency_contact'];
            $member_status = $row['member_status'];
            $plan_id = $row['plan_plan_id'];
        }
        else
        {
            //redirect if id is not in the database
            header('location:'.SITEURL.'manage-member.php');
        }
    }
    else
    {   
        //redirect 
        header('location:'.SITEURL.'manage-member.php');
    }
?>

<div class="main-content">
    <div class="header">
        <h1>Update Member</h1>
        <p>
            <?php
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['remove']))
                {
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>

            <?php
                //pressing the submit btn
                if(isset($_POST['submit']))
                {
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $emergency = $_POST['emergency'];
                    $plan = $_POST['plan'];
                    $status = $_POST['status'];

                    //if the new image is selected
                    if(!empty($_FILES["image"]["name"]))
                    {
                        $image_name = $_FILES['image']['name'];
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/member/".$image_name;
                        
                        $upload = move_uploaded_file($source_path,$destination_path);
                        
                        //if image fail to upload redirect
                        if($upload == false)
                        {
                            $_SESSION['upload'] = "Fail to upload img";
                            header('location:'.SITEURL.'crud/update-member.php');
                            die();
                        }
                        
                        //removing the current image when the new image is uploaded else redirect 
                        if($current_image != "")
                        {
                            $path = "../images/member/".$current_image;
                            $remove = unlink($path);

                            if($remove == false)
                            {
                                $_SESSION['remove'] = "fail to remove image";
                                header('location:'.SITEURL.'crud/update-member.php');
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }

                    $sql3 = "UPDATE member SET
                            image_name = '$image_name',
                            name = '$name',
                            email = '$email',
                            phone = '$phone',
                            emergency_contact = '$emergency',
                            member_status = '$status',
                            plan_plan_id = '$plan'
                            WHERE member_id = $id";

                    $res3 = mysqli_query($conn,$sql3);

                    if($res3 == true){
                        $_SESSION['update'] = "Member Updated";
                        header('location:'.SITEURL.'manage-member.php');
                    }
                    else{
                        $_SESSION['update'] = "Fail to update";
                        header('location:'.SITEURL.'crud/update-member.php');
                    }
                }
            ?>
        </p>
    </div>

    <div class="info">
        <form action="" method = "POST" enctype="multipart/form-data">
            <table class="tbl-30 txt-left">
                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php 
                            if($current_image != "")
                            {
                                ?>
                                <img src="<?php echo SITEURL;?>images/member/<?php echo $current_image?>" width="100px">
                                <?php
                            }
                            else
                            {
                                echo "no image available";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><input type="text" name = "name" value="<?php echo $name;?>" required></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name = "email" value="<?php echo $email;?>" required></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><input type="number" name = "phone" value="<?php echo $phone;?>" required></td>
                </tr>
                <tr>
                    <td>Emergency #</td>
                    <td><input type="number" name="emergency" value="<?php echo $emergency;?>" required></td>
                </tr>
                <tr>
                    <td>Plan</td>
                    <td>
                        <select name="plan">
                            <?php
                                $sql2 = "SELECT * FROM plan";
                                
                                $res2 = mysqli_query($conn,$sql2);

                                $count = mysqli_num_rows($res2);

                                if($count > 0)
                                {
                                    while($row2 = mysqli_fetch_assoc($res2))
                                    {
                                        $plan_id_2 = $row2['plan_id'];
                                        $plan_name = $row2['name'];
                                        ?>
                                            <!-- so if the current plan id matches the plan id from the plan table, it would be selected-->
                                            <option value="<?php echo $plan_id_2?>" <?php if($plan_id == $plan_id_2){echo "SELECTED";}?>>
                                                <?php echo $plan_name?>
                                            </option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="0">No plans available</option>
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
                            <option value="Active" <?php if($member_status=="Active"){echo "SELECTED";}?>>Active</option>
                            <option value="Inactive" <?php if($member_status=="Inactive"){echo "SELECTED";}?>>Inactive</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan = "2">
                        <input type="submit" value="Update" class="btn-primary" name = "submit">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php require_once('../partials/crud-footer.php');?>
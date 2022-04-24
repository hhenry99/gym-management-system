<?php include('../partials/crud-header.php');?>

<?php
    //ID must be pass 
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        
        $sql = "SELECT * FROM user WHERE user_id = $id";
        $res = mysqli_query($conn,$sql);

        if(mysqli_num_rows($res) == 1)
        {
            //get data
            $row = mysqli_fetch_assoc($res);
            $current_image = $row['image_name'];                
            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $emergency = $row['emergency_contact'];
            $username = $row['username'];
            $password = $row['password'];
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
    <div class="header txt-center">
        <h1>Update Member</h1>
        <p>
            <?php
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
                if(isset($_POST['submit'])){
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $emergency = $_POST['emergency'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];

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

                    $sql = "UPDATE user SET
                            username = '$username',
                            password = '$password',
                            image_name = '$image_name',
                            name = '$name',
                            phone = '$phone',
                            emergency_contact = '$emergency',
                            email = '$email'
                            WHERE user_id = $id;
                            ";

                    if(!mysqli_query($conn, $sql)){
                        echo "Oops something went wrong.";
                    } else {
                        $_SESSION['update'] = "<br><span class = 'txt-green'>Member Updated</span>";
                        header('location:'.SITEURL.'manage-member.php');
                    }
                }
            ?>
        </p>
    </div>

    <div class="info">
        <form action="" method = "POST" enctype="multipart/form-data">
            <table class="tbl-wrapper">
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
                    <td>Upload Image</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Name*</td>
                    <td><input type="text" name = "name" value="<?php echo $name;?>" required></td>
                </tr>
                <tr>
                    <td>Email*</td>
                    <td><input type="email" name = "email" value="<?php echo $email;?>" required></td>
                </tr>
                <tr>
                    <td>Phone*</td>
                    <td><input type="number" name = "phone" value="<?php echo $phone;?>" required></td>
                </tr>
                <tr>
                    <td>Emergency #</td>
                    <td><input type="number" name="emergency" value="<?php echo $emergency;?>"></td>
                </tr>
                <tr>
                    <td>Username*</td>
                    <td><input type="text" name="username" value="<?php echo $username;?>" required></td>
                </tr>
                <tr>
                    <td>Password*</td>
                    <td><input type="password" name="password" value="<?php echo $password;?>" required></td>
                </tr>
                <tr>
                    <td>
                        <br>
                        <input type="submit" value="Submit" name = "submit" class = "btn-second">
                    </td>
                    <td>
                        <br>
                        <input type="button" value="Cancel" class = 'btn-cancel' onClick="document.location.href='<?php echo SITEURL;?>manage-member.php';">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php require_once('../partials/crud-footer.php');?>
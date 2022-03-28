<?php
    include('../partials/crud-header.php');
?>

<?php
    if(isset($_GET['aid']) AND isset($_GET['uid']))
    {
        $aid = $_GET['aid'];
        $uid = $_GET['uid'];

        $sql = "SELECT * FROM admin WHERE admin_id = $aid";
        $sql2 = "SELECT * FROM user WHERE user_id = $uid";

        $res = mysqli_query($conn,$sql);

        if(mysqli_num_rows($res) == 1)
        {
            $row = mysqli_fetch_assoc($res);
            $current_img = $row['image_name'];
            $name = $row['name'];
        }
        else
        {
            $_SESSION['no-id-found'] = "Error 404 User Not Found";
            header('location:'.SITEURL.'manage-admin.php');
        }

        $res = mysqli_query($conn,$sql2);

        if(mysqli_num_rows($res) == 1)
        {
            $row = mysqli_fetch_assoc($res);
            $username = $row['username'];
            $password = $row['password'];
            $role = $row['role'];
        }
        else
        {
            $_SESSION['no-id-found'] = "Error 404 User Not Found";
            header('location:'.SITEURL.'manage-admin.php');
        }

    }
    else
    {
        $_SESSION['no-id-found'] = "Error 404 User Not Found";
        header('location:'.SITEURL.'manage-admin.php');
    }
?>

<div class="main-content">
    <div class="header txt-center">
        <h1>Update Admin</h1>
        <?php
            include('../partials/session_check.php');
        ?>
    </div>

    <div class="info">
        <form action="" method = "POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Current Photo:</td>
                    <td>
                        <?php
                        if($current_img == "")
                        {
                            echo "no img available";
                        }
                        else
                        {
                            ?>
                            <img src="<?php echo SITEURL;?>images/admin/<?php echo $current_img;?>" width = "100px">
                            <?php
                        }
                        ?>
                    </td>
                    <input type="hidden" name="current_img" value = "<?php //echo $current_img;?>">
                    <input type="hidden" name="id" value = "<?php //echo $id;?>">
                </tr>

                <tr>
                    <td>Select Photo:</td>
                    <td><input type="file" name="img"></td>
                </tr>

                <tr>
                    <td>Name: </td>
                    <td><input type="text" name="name" value = "<?php echo $name;?>" required></td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type="text" name = "username" value = "<?php echo $username;?>" required></td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type="password" name ="password" value = "<?php echo $password;?>" required></td>
                </tr>
                
                <tr>
                    <td>Role:</td>
                    <td>
                        <select name="role">
                            <option value="3">Admin</option>
                            <option value="4">HAdmin</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name = "submit" value="Update Admin" class = "btn-primary pad-1">
                    </td>
                </tr>
            </table>
        </form>
        
        <?php
            if(isset($_POST['submit']))
            {
                // $aid = $_GET['aid'];
                // $uid = $_GET['uid'];

                $name = $_POST['name'];
                $username = $_POST['username'];
                $password=  $_POST['password'];
                $role = $_POST['role'];

                if(!empty($_FILES['img']['name']))
                {
                    $image_name = $_FILES['img']['name'];
                    $source_path = $_FILES['img']['tmp_name'];
                    $destination_path = "../images/admin/".$image_name;
        
                    //upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);
        
                    //Check whether the img is uploaded or not
                    //And if the image is not uploaded then we will stop the process and redirect with error
                    if($upload==false)
                    {
                        $_SESSION['upload'] = "Failed to upload image";
                        header('location:'.SITEURL.'crud/update-admin.php');
                        die();
                    }

                    if($current_img != "")
                    {
                        $path = '../images/admin/'.$current_img;
                        $remove = unlink($path);
                        
                        if($remove == false)
                        {
                            $_SESSION['remove'] = "Fail to remove image";
                            header('location:'.SITEURL.'crud/update-admin.php');
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = $current_img;
                }

                $sql = "UPDATE admin SET
                image_name = '$image_name',
                name = '$name'
                WHERE admin_id = $aid;
                ";
        
                $sql2 = "UPDATE user SET
                username = '$username',
                password = '$password',
                role = $role
                WHERE user_id = $uid;
                ";

                $res = mysqli_query($conn,$sql);
                $res2 = mysqli_query($conn,$sql2);

                $_SESSION['update'] = "Admin Updated!";
                header('location:'.SITEURL.'manage-admin.php');
            }
        ?>
    </div>
</div> 

<?php include("../partials/crud-footer.php");?>
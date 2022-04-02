<?php
include('../partials/crud-header.php');

if(isset($_GET['uid']))
{
    $uid = $_GET['uid'];
    $sql = "SELECT * FROM user WHERE user_id = $uid";
    $res = mysqli_query($conn,$sql);

    if(mysqli_num_rows($res) == 1)
    {
        $row = mysqli_fetch_assoc($res);
        $username = $row['username'];
        $password = $row['password'];
        $role = $row['role'];
        $current_img = $row['image_name'];
        $name = $row['name'];
    }
    else
    {
        header('location:'.SITEURL.'manage-admin.php');
    }
}
else
{
    header('location:'.SITEURL.'manage-admin.php');
}
?>

<div class="main-content">
    <div class="header txt-center">
        <h1>Update Admin</h1>
        <p>
        <?php
            include('../partials/session_check.php');
        ?>
        </p>

    <?php
    if(isset($_POST['submit']))
    {
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

        $sql = "UPDATE user SET
        username = '$username',
        password = '$password',
        role = $role,
        image_name = '$image_name',
        name = '$name'
        WHERE user_id = $uid;
        ";

        $res = mysqli_query($conn,$sql);

        $_SESSION['update'] = "<p class = 'txt-green'>Admin Updated!</p>";
        header('location:'.SITEURL.'manage-admin.php');
    }
    ?>
    </div>

    <div class="info">
        <form action="" method = "POST" enctype="multipart/form-data">
            <table class="tbl-wrapper">
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
                </tr>

                <tr>
                    <td>Upload Photo:</td>
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
                            <option value="3" <?php if($role == 3) {echo "selected";}?>>Admin</option>
                            <option value="4" <?php if($role == 4) {echo "selected";}?>>HAdmin</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <input type="submit" name = "submit" value="+ Admin" class = "btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div> 

<?php include("../partials/crud-footer.php");?>
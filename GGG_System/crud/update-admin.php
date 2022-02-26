<?php
    include('../partials/crud-header.php');
?>

<div class="main-content">
    <div class="header">
        <h2 class ="txt-center">Update Admin</h2>
    </div>

    <?php

        if(isset($_GET['id']))
        {
            $id = $_GET['id'];

            $sql = "SELECT * FROM admin WHERE admin_id = $id";

            $res = mysqli_query($conn,$sql);
            
            $count = mysqli_num_rows($res);

            if($count == 1)
            {
                $row = mysqli_fetch_assoc($res);
                $current_img = $row['image_name'];
                $name = $row['name'];
                $username = $row['username'];
                $password = $row['password'];
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
    <div class="info">
        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
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
                    <input type="hidden" name="current_img" value = "<?php echo $current_img;?>">
                    <input type="hidden" name="id" value = "<?php echo $id;?>">
                </tr>

                <tr>
                    <td>Select Photo:</td>
                    <td><input type="file" name="img"></td>
                </tr>

                <tr>
                    <td>Name: </td>
                    <td><input type="text" name="name" value = "<?php echo $name;?>"></td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type="text" name = "username" value = "<?php echo $username;?>"></td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type="password" name ="password" value = "<?php echo $password;?>"></td>
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
                $id = $_POST['id'];
                $current_img = $_POST['current_img'];
                $name = $_POST['name'];
                $username = $_POST['username'];
                $password=  $_POST['password'];

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
                        //redirect to add-food
                        header('location:'.SITEURL.'update-admin.php');
                        //stop 
                        die();
                    }

                    if($current_img != "")
                    {
                        $path = '../images/admin/'.$current_img;
                        $remove = unlink($path);
                        
                        if($remove == false)
                        {
                            $_SESSION['remove'] = "Fail to remove image";
                            header('location:'.SITEURL.'update-admin.php');
    
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = $current_img;
                }


                $sql2 = "UPDATE admin SET
                        image_name = '$image_name',
                        name = '$name',
                        username = '$username',
                        password = '$password'
                        WHERE admin_id = $id;
                        ";

                $res2 = mysqli_query($conn,$sql2);

                if($res2 == true)
                {
                    $_SESSION['update'] = "Admin Updated!";
                    header('location:'.SITEURL.'manage-admin.php');
                }
                else
                {
                    $_SESSION['update'] = "Fail to update admin";
                    header('location:'.SITEURL.'update-admin.php');
                }
                
            }
        ?>
    </div>
</div> 

<?php include("../partials/crud-footer.php");?>
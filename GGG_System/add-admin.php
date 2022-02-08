<?php include("partials/header.php"); ?>

<div class="main-content">
    <div class="header">
        <h1 class = "txt-center">Add Admin</h1>
    </div>

    <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
    ?>
    <div class="info">
        <form action="" method="POST" enctype="multipart/form-data">
            <table class = "tbl-30">
                <tr>
                    <td>Select photo</td>
                    <td><input type="file" name="img"></td>
                </tr>

                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name = "name"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name = "username"></td>
                </tr>

                <tr>
                    <td>Password</td>
                    <td><input type="password" name = "password"></td>
                </tr>

                <tr>
                    <td colspan = "3">
                        <input type="submit" value="Add Admin" name = "submit" class = "btn-primary pad-1">
                    </td>
                </tr>
            </table>
        </form>
    </div>
   
    <?php
        if(isset($_POST['submit']))
        {
            $full_name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            if(!empty($_FILES['img']['name']))
            {
                $image_name = $_FILES['img']['name'];
                $source_path = $_FILES['img']['tmp_name'];
                $destination_path = "images/admin/".$image_name;
    
                //upload the image
                $upload = move_uploaded_file($source_path, $destination_path);
    
                //Check whether the img is uploaded or not
                //And if the image is not uploaded then we will stop the process and redirect with error
                if($upload==false)
                {
                    $_SESSION['upload'] = "Failed to upload image";
                    //redirect to add-food
                    header('location:'.SITEURL.'add-admin.php');
                    //stop 
                    die();
                }
            }
            else
            {
                $image_name = "";
            }

            $sql = "INSERT INTO admin SET
                    image_name = '$image_name',
                    name = '$full_name',
                    username = '$username',
                    password = '$password'
                    ";

            $res = mysqli_query($conn,$sql);

            if($res == true)
            {
                $_SESSION['add'] = "Admin added successfully";
                header('location:'.SITEURL.'manage-admin.php');
            }
            else
            {
                $_SESSION['add'] = "Fail to add Admin";
                header('location:'.SITEURL.'add-admin.php');
            }

        }
    ?>

</div>


<?php include("partials/footer.php"); ?>
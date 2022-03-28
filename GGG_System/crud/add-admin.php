<?php 
include("../partials/crud-header.php"); 
include("../functions.php");


if(isset($_GET['fn']) AND isset($_GET['password'])){
    $full_name = $_GET['fn'];
    $password = $_GET['password'];
}
else{
    $full_name = "";
    $password = "";
}
?>


<div class="main-content">
    <div class="header txt-center">
        <h1>Add Admin</h1>
    </div>

    <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
    ?>
    
    <div class="info">
        <div class="table-center">
            <form action="" method="POST" enctype="multipart/form-data">
                <table class = "tbl-30">
                    <tr>
                        <td>Select photo</td>
                        <td><input type="file" name="img"></td>
                    </tr>

                    <tr>
                        <td>Full Name</td>
                        <td><input type="text" name = "name" value = "<?php echo $full_name;?>" required></td>
                    </tr>

                    <tr>
                        <td>Username</td>
                        <td><input type="text" name = "username" required></td>
                    </tr>

                    <tr>
                        <td>Password</td>
                        <td><input type="password" name = "password" value = "<?php echo $password;?>" required></td>
                    </tr>

                    <tr>
                        <td>Role</td>
                        <td>
                            <select name="role" id="">
                                <option value="3">Admin</option>
                                <option value="4">HAdmin</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td colspan = "3">
                            <input type="submit" value="Add Admin" name = "submit" class = "btn-primary pad-1">
                        </td>
                    </tr>
                </table>
                <?php
                    if(isset($_SESSION['username']))
                    {
                        echo $_SESSION['username'];
                        unset($_SESSION['username']);
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                ?>
            </form>
        </div>
    </div>
   
    <?php

        if(isset($_POST['submit']))
        {
            $full_name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            
            if(checkusername($username, $conn, $role) == false){
                $_SESSION['username'] = "Sorry ... Username Taken!";
                header("location:".SITEURL."crud/add-admin.php?fn=$full_name&password=$password");
                die();
            }

            // echo print_r($_FILES['img']);
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
                    header('location:'.SITEURL.'crud/add-admin.php');
                    die();
                }
            }
            else
            {
                $image_name = "";
            }

            $sql = "INSERT INTO user (username, password, role) VALUES ('test','test',$role);";
            $sql2 = "INSERT INTO admin (image_name, name, user_user_id) VALUES ('$image_name', '$full_name', LAST_INSERT_ID());";

            $res = mysqli_query($conn, $sql) or die("Error");
            $res = mysqli_query($conn, $sql2) or die("Error");

            $_SESSION['add'] = "Admin added successfully";
            header('location:'.SITEURL.'manage-admin.php');
        }
    ?>

</div>

<?php include('../partials/crud-footer.php');?>
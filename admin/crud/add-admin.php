<?php 
include("../partials/crud-header.php"); 
include("../functions.php");

if(ROLE != 4){
    header('location:'.SITEURL.'index.php');
    die();
}

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
        <?php
            include('../partials/session_check.php');
        ?>
    </div>
    
    <?php
    //pressing submit btn
    if(isset($_POST['submit']))
    {
        $full_name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

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

        $sql = "INSERT INTO user (username, password, role, image_name, name, phone, email, account_date_created) VALUES ('$username', '$password', $role, '$image_name', '$full_name', '$phone', '$email', NOW());";

        $res = mysqli_query($conn, $sql) or die("Error");

        $_SESSION['add'] = "<span class = 'txt-green'>Admin added successfully</span>";
        header('location:'.SITEURL.'manage-admin.php');
    }
    ?>

    <div class="info">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="tbl-wrapper">
                <table class = "tbl-30">
                    <tr>
                        <td>Upload Photo</td>
                        <td><input type="file" name="img" id=""></td>
                    </tr>
                    <tr>
                        <td>Full Name*</td>
                        <td><input type="text" name="name" id="" value = "<?php echo $full_name;?>" placeholder = "John Doe" required></td>
                    </tr>
                    <tr>
                        <td>Username*</td>
                        <td><input type="text" name = "username" placeholder = "JohnDoe123" required></td>
                    </tr>
                    <tr>
                        <td>Password*</td>
                        <td><input type="password" name = "password" value = "<?php echo $password;?>" placeholder = "Password123" required></td>
                    </tr>
                    <tr>
                        <td>Phone*</td>
                        <td><input type="number" name="phone" id="" placeholder = "#" requred></td>
                    </tr>
                    <tr>
                        <td>Email*</td>
                        <td><input type="email" name = "email" placeholder = "JohnDoe1@gmail.com" required></td>
                    </tr>
                    <tr>
                        <td>Role*</td>
                        <td>
                            <select name="role" id="">
                                <option value="3">Admin</option>
                                <option value="4">HAdmin</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <input type="submit" value="Submit" name = "submit" class = "btn-second">
                        </td>
                        <td>
                            <br>
                            <input type="button" value="Cancel" class = 'btn-cancel' onClick="document.location.href='<?php echo SITEURL;?>manage-admin.php';">
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>  
</div>

<?php include('../partials/crud-footer.php');?>
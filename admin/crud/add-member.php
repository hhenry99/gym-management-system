<?php 
include('../partials/crud-header.php');
include('../functions.php');
?>

<div class="main-content">
    <div class="header txt-center">
        <h1>Add Member</h1>
        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
    </div>

    <div class="info">
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-wrapper">
                <tr>
                    <td>Image</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Full Name*</td>
                    <td><input type="text" name = "name" required></td>
                </tr>   
                <tr>
                    <td>Email*</td>
                    <td><input type="email" name="email" required></td>
                </tr>
                <tr>
                    <td>Phone*</td>
                    <td><input type="number" name = "phone" required></td>
                </tr>
                <tr>
                    <td>Emergency #</td>
                    <td><input type="number" name="emergency"></td>
                </tr>
                <tr>
                    <td>Username*</td>
                    <td><input type="text" name="username" required></td>
                </tr>
                <tr>
                    <td>Password*</td>
                    <td><input type="password" name="password" required></td>
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

        <?php
            if(isset($_POST['submit']))
            {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $emergency = $_POST['emergency'];
                $username = $_POST['username'];
                $password = $_POST['password'];

                if(!checkusername($username, $conn, 1)){
                    echo "Username Taken!";
                    die();
                }
                // else {
                //     echo "username is available!";
                // }

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

                $sql = "INSERT INTO user SET
                        username = '$username',
                        password = '$password',
                        role = 1,
                        image_name = '$image_name',
                        name = '$name',
                        phone = '$phone',
                        emergency_contact = '$emergency',
                        email = '$email',
                        account_date_created = NOW(),
                        status = 0;
                        ";

                if(!mysqli_query($conn, $sql)){
                    echo "Something is wrong with the query!";
                } else {
                    $_SESSION['add'] = "<span class = 'txt-green'>Member Added!</span>";
                    header('location:'.SITEURL.'manage-member.php');
                }

            }
        ?>
    </div>
</div>
<?php include('../partials/crud-footer.php');?>
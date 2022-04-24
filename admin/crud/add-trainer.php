<?php 
include('../partials/crud-header.php');
include('../functions.php');
?>

<div class="main-content">
    <div class="header txt-center">
        <h1>Add Trainer</h1>
        <p><?php include('../partials/session_check.php')?></p>
    </div>

    <?php
    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $ephone = $_POST['ephone'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(!checkusername($username, $conn, 2)){
            $_SESSION['username'] = "Username taken!";
            header('location:'.SITEURL.'crud/add-trainer.php');
            die();
        }

        if(!empty($_FILES['img']['name']))
        {
            $image = $_FILES['img']['name'];
            $source = $_FILES['img']['tmp_name'];
            $destination = "../images/trainer/".$image;
            
            $upload = move_uploaded_file($source, $destination);
        }
        else{
            $image = "";
        }

        $sql = "INSERT INTO user SET
                username = '$username',
                password = '$password',
                role = 2,
                image_name = '$image',
                name = '$name',
                email = '$email',
                phone = '$phone',
                emergency_contact = '$ephone',
                account_date_created = NOW()
                ";

        $res = mysqli_query($conn,$sql);

        $_SESSION['add'] = "<br><span class = 'txt-green'>Trainer added</span>";
        header('location:'.SITEURL.'manage-trainer.php');
    }
    ?>

    <div class="info">
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-wrapper">
                <tr>
                    <td>Upload Image</td>
                    <td><input type="file" name="img"></td>
                </tr>
                <tr>
                    <td>Name*</td>
                    <td>
                        <input type="text" name="name" required>
                    </td>
                </tr>
                <tr>
                    <td>Email*</td>
                    <td><input type="email" name="email" required></td>
                </tr>
                <tr>
                    <td>Phone*</td>
                    <td><input type="number" name="phone" required></td>
                </tr>
                <tr>
                    <td>Emergency #</td>
                    <td><input type="number" name="ephone"></td>
                </tr>
                <tr>
                    <td>Username*</td>
                    <td><input type="text" name = "username" required></td>
                </tr>
                <tr>
                    <td>Password*</td>
                    <td><input type="password" name = "password" required></td>
                </tr>
                <tr>
                    <td>
                        <br>
                        <input type="submit" value="Submit" name = "submit" class = "btn-second">
                    </td>
                    <td>
                        <br>
                        <input type="button" value="Cancel" class = 'btn-cancel' onClick="document.location.href='<?php echo SITEURL;?>manage-trainer.php';">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('../partials/crud-footer.php');?>
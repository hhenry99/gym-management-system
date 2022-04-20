<?php
include('partials/header.php');

$id = $_SESSION['user_id'];

$sql = "SELECT * FROM user WHERE user_id = $id";
$res = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($res);
$username = $row['username'];
$password = $row['password'];
$current_img = $row['image_name'];
$phone = $row['phone'];
$emergency = $row['emergency_contact'];
$email = $row['email'];

?>

<?php 
if(isset($_POST['submit']))
{
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $ephone = $_POST['ephone'];
    $username = $_POST['username'];
    $password= $_POST['password'];

    if(!empty($_FILES['image']['name']))
    {
        $image = $_FILES['image']['name'];
        $source = $_FILES['image']['tmp_name'];
        $destination = "../ggg_system/images/trainer/".$image;
        
        $upload = move_uploaded_file($source, $destination);

        if($upload == true)
        {
            if($current_img != "")
            {
                $path = "../ggg_system/images/trainer/".$current_img;
                $remove = unlink($path);
            }
        }
    }
    else
    {
        $image = $current_img;
    }

    $sql2 = "UPDATE user set 
            image_name = '$image',
            email = '$email',
            phone = '$phone',
            emergency_contact = '$ephone',
            username = '$username',
            password = '$password'
            WHERE user_id = $id;
            ";

    $res2 = mysqli_query($conn,$sql2);

    $_SESSION['update'] = "<br><span class = 'txt-green'>Trainer Updated Success!</span>";
    header('location:'.SITEURL.'trainer/profile.php');
}

if(isset($_POST['cancel'])){
    header('location:'.SITEURL.'trainer/profile.php');
}

?>
<div class="main-content">
    <div class="header txt-center">
        <h1>Update Profile</h1>
    </div>

    <div class="info">
        <form action="" method="post" enctype="multipart/form-data">
            <table class = 'tbl-wrapper'>
                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php 
                        if($current_img != ""){
                            ?>
                            <img src="<?php echo SITEURL.'ggg_system/images/trainer/'.$current_img;?>" width = "100px">
                            
                            <?php
                        } else {
                            echo "No Image Available";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Upload Image</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Email*</td>
                    <td><input type="email" name="email" value = "<?php echo $email;?>" required></td>
                </tr>
                <tr>
                    <td>Phone*</td>
                    <td><input type="number" name="phone" value = "<?php echo $phone;?>" required></td>
                </tr>
                <tr>
                    <td>Emergency #*</td>
                    <td><input type="number" name="ephone" value = "<?php echo $emergency;?>" required></td>
                </tr>
                <tr>
                    <td>Username*</td>
                    <td><input type="text" name="username" value = "<?php echo $username;?>" required></td>
                </tr>
                <tr>
                    <td>Password*</td>
                    <td><input type="password" name="password" value = "<?php echo $password;?>" required></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Update" name = 'submit'>
                    </td>
                    <td>
                        <input type="submit" value="cancel" name = 'cancel'>
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
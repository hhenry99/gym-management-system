<?php 
include('partials/header.php');

$id = $_SESSION['user_id'];

$sql = "SELECT * FROM user WHERE user_id = $id";
$res = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($res);
$username = $row['username'];
$name = $row['name'];
$image_name = $row['image_name'];
$phone = $row['phone'];
$emergency = $row['emergency_contact'];
$email = $row['email'];
?>

<div class="main-content">
    <div class="header txt-center">
        <h1>My Profile</h1>
        <?php 
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
    </div>

    <div class="info">
            <div class="img-container">
            <?php 
            if($image_name != ""){
                ?>
                <img src="<?php echo SITEURL.'ggg_system/images/trainer/'.$image_name;?>" width = '100px'>
                <?php
            } else {
                echo "No Img Available";
            }
            ?>
            </div>
            <div class="info-container">
                <div class="info-box">
                    <p>Name:</p>
                    <p><?php echo $name;?></p>
                </div>
                <div class="info-box">
                    <p>Phone</p>
                    <p><?php echo $phone;?></p>
                </div>
                <div class="info-box">
                    <p>Email</p>
                    <p><?php echo $email;?></p>
                </div>
                <div class="info-box">
                    <p>Emergency Contact</p>
                    <p><?php echo $emergency;?></p>
                </div>
                <div class="info-box">
                    <p>Username</p>
                    <p><?php echo $username;?></p>
                </div>
                <div class="info-box">
                    <p>
                        <button><a href="<?php echo SITEURL;?>trainer/update-trainer.php">Update</a></button>
                    </p>
                </div>
            </div>
    </div>
</div>



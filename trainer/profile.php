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
        <div class="info-wrapper">
            <div class="img-container">
                <?php 
                if($image_name != ""){
                    ?>
                    <img src="<?php echo SITEURL.'admin/images/trainer/'.$image_name;?>" width = '100px'>
                    <?php
                } else {
                    echo "No Img Available";
                }
                ?>
            </div>
            <div class="info-container">
                <table>
                    <tr>
                        <td>Username</td>
                        <td><?php echo $username;?></td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td><?php echo $name;?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $email;?></td>
                    </tr>
                    <tr>
                        <td>Phone:</td>
                        <td><?php echo $phone;?></td>
                    </tr>
                    <tr>
                        <td>Emergency Contact:</td>
                        <td><?php echo $emergency;?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <br>
                        <a href="<?php echo SITEURL;?>trainer/update-trainer.php"><button>Update</button></a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>



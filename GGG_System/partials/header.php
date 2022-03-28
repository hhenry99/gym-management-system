<?php 
include("config/constant.php");
include("login-check.php");
?>

<?php
$suid = $_SESSION['user'];
$sql = "SELECT role from user WHERE user_id = $suid;";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$urole = $row['role'];

$site = SITEURL;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GGG Management System</title>
    <link rel="stylesheet" href="<?php echo SITEURL;?>css/style.css">
</head>
<body>

    <div class="wrapper">
        <div class="sidebar">
            <h2>GoGoGym</h2>
            <ul>
                <li><a href="<?php echo SITEURL;?>index.php">Dashboard</a></li>
                <?php 
                    if($urole == 4){
                        echo "<li><a href='{$site}manage-admin.php'>Admin</a></li>";
                    }
                ?>
                <li><a href="<?php echo SITEURL;?>manage-plan.php">Plan</a></li>
                <li><a href="<?php echo SITEURL;?>manage-member.php">Member</a></li>
                <li><a href="<?php echo SITEURL;?>manage-trainer.php">Trainer</a></li>
                <li><a href="<?php echo SITEURL;?>manage-equipment.php">Equipment</a></li>
                <li><a href="<?php echo SITEURL;?>manage-class.php">Class</a></li>
                <li><a href="<?php echo SITEURL;?>manage-invoice.php">Invoice</a></li>
                <li><a href="<?php echo SITEURL;?>logout.php">Log Out</a></li>
            </ul>
        </div>
        
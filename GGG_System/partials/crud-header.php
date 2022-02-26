<?php 
require_once("../config/constant.php");
require_once("login-check.php");
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
                <li><a href="<?php echo SITEURL;?>manage-admin.php">Admin</a></li>
                <li><a href="<?php echo SITEURL;?>manage-plan.php">Plan</a></li>
                <li><a href="<?php echo SITEURL;?>manage-member.php">Member</a></li>
                <li><a href="<?php echo SITEURL;?>manage-trainer.php">Trainer</a></li>
                <li><a href="<?php echo SITEURL;?>manage-equipment.php">Equipment</a></li>
                <li><a href="<?php echo SITEURL;?>manage-class.php">Class</a></li>
                <li><a href="<?php echo SITEURL;?>manage-invoice.php">Invoice</a></li>
                <li><a href="<?php echo SITEURL;?>logout.php">Log Out</a></li>
            </ul>
        </div>

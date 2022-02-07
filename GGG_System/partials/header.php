<?php 

include("config/constant.php");
include("login-check.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GGG Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="wrapper">
        <div class="sidebar">
            <h2>GoGoGym</h2>
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-plan.php">Plan</a></li>
                <li><a href="manage-member.php">Member</a></li>
                <li><a href="manage-trainer.php">Trainer</a></li>
                <li><a href="manage-equipment.php">Equipment</a></li>
                <li><a href="manage-class.php">Class</a></li>
                <li><a href="manage-payment.php">Payment</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
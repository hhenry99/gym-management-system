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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>

    <div class="wrapper">
        <div class="sidebar">
            <h2>GoGoGym</h2>
            <ul>
                <li><a href="index.php">DashBoard <i class="fa-solid fa-house"></i></a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="<?php echo SITEURL;?>trainer/logout.php">Log Out</a></li>
            </ul>
        </div>
        
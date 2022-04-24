<?php 
    include("config/constant.php");
    include("login-check.php");
?>

<?php
$id = $_SESSION['user_id'];
$sql = "SELECT image_name, name FROM user WHERE user_id = $id";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$image = $row['image_name'];
$name = $row['name'];
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

    <div class="wrapper">
        <div class="sidebar">
            <h2>GoGoGym</h2>
            <ul>
                <li>
                    <?php 
                    echo "<h3>HELLO, ".$name."</h3>";
                    ?>
                </li>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="<?php echo SITEURL;?>trainer/logout.php">Log Out</a></li>
            </ul>
        </div>
        
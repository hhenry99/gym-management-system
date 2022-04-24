<?php 
include('config/constant.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="wrapper text-center">
        <h1>Login</h1>

        <div class="input-wrapper">
        <?php

        if(isset($_SESSION['logout']))
        {
            echo "<br><p class ='txt-red'>".$_SESSION['logout']."</p>";
            unset($_SESSION['logout']);
            session_destroy();
        } else {
            if(isset($_SESSION['user'])){
                header('location: index.php');
                die();
            }
            if(isset($_SESSION['user_id'])){
                header('location: ../trainer/index.php');
                die();
            }
            //Wrong login information message
            if(isset($_SESSION['login']))
            {
                echo "<br><p class ='txt-red'>".$_SESSION['login']."</p>";
                unset($_SESSION['login']);
            }

            //Error message when trying to access the admin panel or trainer panel without login in
            if(isset($_SESSION['no-login-message']))
            {
                echo "<br><p class = 'txt-red'>".$_SESSION['no-login-message']."</p>";
                unset($_SESSION['no-login-message']);
            }
        }
        ?>
        <br>
        <br> 
        </div>

        <form action="" method = "POST">
            <label for="username">Username:</label>
            <br>
            <input type="text" name = "username" required>
            <br>
            <br>
            <label for="password">Password:</label>
            <br>
            <input type="password" name = "password" required>
            <br>
            <br>
            <br>
            <select name="role">
                <option value="2">Trainer</option>
                <option value="3">Admin</option>
                <option value="4">HAdmin</option>
            </select>
            <input type="submit" value="Log In" name = "submit" class = "btn-primary">
        </form>

        <?php
        if(isset($_POST['submit']))
        {
            $username = $_POST['username'];
            $password=  $_POST['password'];
            $role = $_POST['role'];

            if($role == 2){
                $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password' and role = $role";
                $res = mysqli_query($conn, $sql);
                if(mysqli_num_rows($res) == 1){
                    $row = mysqli_fetch_assoc($res);
                    $id = $row['user_id'];
                    $_SESSION['login'] = "Login successful .... ";
                    $_SESSION['user_id'] = $id;
                    header('location: http://localhost/gym-management-system/trainer/index.php.');
                }
                else{
                    $_SESSION['login'] = "Incorrect username or password";
                    header('location:'.SITEURL.'login.php');
                }
            }
            else if($role == 3){
                $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password' and role = $role";
                $res = mysqli_query($conn, $sql);
                if(mysqli_num_rows($res) == 1){
                    $row = mysqli_fetch_assoc($res);
                    $id = $row['user_id'];
                    $_SESSION['login'] = "Login successful .... ";
                    $_SESSION['user'] = $id;
                    header('location:'.SITEURL.'index.php');
                }
                else
                {
                    $_SESSION['login'] = "Incorrect username or password";
                    header('location:'.SITEURL.'login.php');
                }
            }
            else if($role == 4){
                $sql = "SELECT user_id FROM user WHERE username = '$username' AND password = '$password' and role = $role";
                $res = mysqli_query($conn, $sql);
                if(mysqli_num_rows($res) == 1){
                    $row = mysqli_fetch_assoc($res);
                    $id = $row['user_id'];
                    $_SESSION['login'] = "Login successful .... ";
                    $_SESSION['user'] = $id;
                    header('location:'.SITEURL.'index.php');
                }
                else
                {
                    $_SESSION['login'] = "Incorrect username or password";
                    header('location:'.SITEURL.'login.php');
                }
            }
        }
    ?>  
    </div>   
</body>
</html>

<?php include('config/close-connection.php'); ?>
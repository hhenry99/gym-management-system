<?php include('config/constant.php');?>

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
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['no-login-message']))
        {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
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
            <input type="submit" value="Log In" name = "submit" class = "btn-primary">
        </form>

        <?php
        if(isset($_POST['submit']))
        {
            $username = $_POST['username'];
            $password=  $_POST['password'];

            $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password';";
            
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count == 1)
            {
                // echo "Data found";
                $_SESSION['login'] = "Login successful";

                $_SESSION['user'] = $username;
                
                header('location:'.SITEURL.'index.php');
            }
            else
            {
                $_SESSION['login'] = "Incorrect username or password";
                header('location:'.SITEURL.'login.php');
            }
            
        }
    ?>  
    </div>   
</body>
</html>


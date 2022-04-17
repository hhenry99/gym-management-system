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
        <!-- <p>Don't Have an Account? <a href="signup.php">Sign Up</a></p>  -->
        <div class="input-wrapper">
        <?php
        if(isset($_SESSION['login']))
        {
            echo "<br><p class ='txt-red'>".$_SESSION['login']."</p>";
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['no-login-message']))
        {
            echo "<br><p class = 'txt-red'>".$_SESSION['no-login-message']."</p>";
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
            <br>
            <select name="role">
                <!-- <option value="1">Member</option> -->
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

            if($role == 1){
                // $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password' and role = $role";
                // $res = mysqli_query($conn, $sql);
                // if(mysqli_num_rows($res) == 1){
                //     $_SESSION['login'] = "Login successful .... ";
                //     $_SESSION['user'] = $username;
                //     header('location: http://localhost/gym-management-system/member/index.php.');
                // }
                // else
                // {
                //     $_SESSION['login'] = "Incorrect username or password";
                //     header('location:'.SITEURL.'login.php');
                // }
            }
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
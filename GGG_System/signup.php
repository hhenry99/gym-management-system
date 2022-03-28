<?php include('config/constant.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
</head>
<body>
    <h1>SignUp</h1>
    <p>Already Have an Account? <a href="login.php">Log In</a></p>
    <hr>
    <form action="" method="post">
        <label for="first">First Name</label>
        <input type="text" placeholder="First Name" name = "first" required>
        <br>
        <label for="first">Last Name</label>
        <input type="text" placeholder="Last Name" name = "last" required>
        <br>
        <label for="email">Email</label>
        <input type="email" placeholder="Email" name = "email"required>
        <br>
        <label for="phone">Contact Phone</label>
        <input type="number" placeholder="Phone #" name="phone" required>
        <br>
        <label for="username">Username</label>
        <input type="text" placeholder="Username" name="username" required>
        <br>
        <label for="password">Password</label>
        <input type="text" placeholder="Password" name="password" required>
        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
<?php
    //check wehtehr the user is logeed in or not
    if(isset($_SESSION['user'])){
        $uid = $_SESSION['user'];
        $sql = "SELECT role, name from user WHERE user_id = $uid;";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $role = $row['role'];
        $name = $row['name'];
    
        define("ID", $uid);
        define('ROLE', $role);
        define('NAME', $name);
    } else {
        $_SESSION['no-login-message'] = "<div class = 'error text-center'>Please login to access admin panel.</div>";
        header('location:'.SITEURL.'login.php');
        die();
    }
?>
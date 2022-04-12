<?php
    //check wehtehr the user is logeed in or not
    if(isset($_SESSION['user'])){
        $uid = $_SESSION['user'];
        $sql = "SELECT role, name, image_name from user WHERE user_id = $uid;";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $role = $row['role'];
        if($role == 1 or $role == 2){
            $_SESSION['login'] = '';
            $_SESSION['no-login-message'] = "<div class = 'error text-center'>Please login to access admin panel.</div>";
            //redirect to login page
            header('location:'.SITEURL.'login.php');
            die();
        }
        $name = $row['name'];
        $img = $row['image_name'];
    
        define("ID", $uid);
        define('ROLE', $role);
        define('NAME', $name);
        define('IMG', $img);
        

    } else {
        $_SESSION['no-login-message'] = "<div class = 'error text-center'>Please login to access admin panel.</div>";
        header('location:'.SITEURL.'login.php');
        die();
    }

    // if(!isset($_SESSION['user']))
    // {
    //     $_SESSION['no-login-message'] = "<div class = 'error text-center'>Please login to access admin panel.</div>";
    //     //redirect to login page
    //     header('location:'.SITEURL.'login.php');
    //     die();
    // }

    // $uid = $_SESSION['user'];
    // $sql = "SELECT role, name, image_name from user WHERE user_id = $uid;";
    // $res = mysqli_query($conn, $sql);
    // $row = mysqli_fetch_assoc($res);
    // $role = $row['role'];
    // $name = $row['name'];
    // $img = $row['image_name'];

    // define("ID", $uid);
    // define('ROLE', $role);
    // define('NAME', $name);
    // define('IMG', $img);
    
?>
<?php
include('config/constant.php'); 

$_SESSION['logout'] = "Log Out Success!";

header('location:'.SITEURL.'admin/login.php');

mysqli_close($conn);
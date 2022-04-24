<?php
include('config/constant.php'); 

$_SESSION['logout'] = 'Log Out Success';

header('location:'.SITEURL.'login.php');

include('config/close-connection.php');
<?php
    session_start();

    //Create constants to store non repeating values
    define('LOCALHOST', 'localhost');
    define('USERNAME', 'root');
    define('PASSWORD', '');
    define('DB_NAME', 'ggg_db');
    define('SITEURL', 'http://localhost/ggg_system/');
    
    $conn = mysqli_connect(LOCALHOST, USERNAME, PASSWORD, DB_NAME) or die(mysqli_error());

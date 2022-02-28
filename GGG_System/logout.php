<?php
include('config/constant.php'); 

session_destroy();  //destroying all of the sessions

header('location:'.SITEURL.'login.php');

include('config/close-connection.php');
<?php
include('config/constant.php'); 

session_destroy();  //destroying all of the sessions

header('location:'.SITEURL.'ggg_system/login.php');

include('config/close-connection.php');
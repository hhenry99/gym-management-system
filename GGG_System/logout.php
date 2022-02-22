<?php
include('config/constant.php');

session_destroy();

header('location:'.SITEURL.'login.php');

include('config/close-connection.php');
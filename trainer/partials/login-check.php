<?php
include('../function.php');

if(isset($_SESSION['user'])){
    if(checkTrainerLogin($conn, $_SESSION['user']) == true){
        echo "Error";
        die();
    }
}

?>
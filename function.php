<?php

//check to see if trainer is log in 
function checkTrainerLogin($conn, $id){
    $error = false;
    $sql = "SELECT role from user where user_id = $id AND role = 2";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) != 1){
        $error = true;
    }
    return $error;
}

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

//check to see if the member is already in the class
function checkClass($conn, $classid, $memberid){
    $error = false;
    $sql = "SELECT regist_id FROM registration where class_class_id = $classid AND user_user_id = $memberid AND class_status = 1";
    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res) > 0){
        $error = true;
    } 
    return $error;
}


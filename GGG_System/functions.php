<?php 

function checkusername($username, $conn){
    $sql = "SELECT * from admin WHERE username = '$username';";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if($count != 0){
        //the user name exist
        return false; 
    }else{
        //the username does not exist
        return true;
    }

}



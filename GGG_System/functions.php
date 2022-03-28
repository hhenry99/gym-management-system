<?php 

//Check username if its already used 
function checkusername($username, $conn, $role){
    $sql = "SELECT user_id from user WHERE username = '$username' AND role = $role;";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if($count != 0){
        //the username exist
        return false; 
    }else{
        //the username is available
        return true;
    }
}



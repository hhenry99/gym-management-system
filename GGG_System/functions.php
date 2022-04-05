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

//check to see if the member is already in the class
function checkClass($conn, $classid, $memberid){
    $error = false;
    $sql = "SELECT * FROM registration where class_class_id = $classid AND user_user_id = $memberid";
    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res) > 0){
        $error = true;
    } 
    return $error;
}

//check to see if there are members in the class, if there is unable to delete class
function checkMemberClass(){

}

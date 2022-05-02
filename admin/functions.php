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
    $sql = "SELECT regist_id FROM registration where class_class_id = $classid AND user_user_id = $memberid AND class_status = 1";
    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res) > 0){
        $error = true;
    } 
    return $error;
}

//check to see if the trainers are in any class, if they are unable to delete them
function checkTrainer($conn, $id){
    $error = false;
    $sql = "SELECT user_user_id FROM class where user_user_id = $id";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
        $error = true;
    }
    return $error;
}

//check to see if there are members in the class, if there is unable to delete class
function checkMemberClass($conn, $id){
    $error = false;
    $sql = "SELECT regist_id FROM registration WHERE class_class_id = $id";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0) {
        $error = true;
    }
    return $error;
}

//check to see if theres any payments inside of invoice, if there is unable to delete invoice
function checkInvoicePay($conn, $invoiceid){
    $error = false;
    $sql = "SELECT payment_id FROM payment where invoice_invoice_id = $invoiceid";
    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res) > 0){
        $error = true;
    }
    return $error;
}


//Check if member has a plan (only 1 plan can be active at a time)
function checkPlan($conn, $member_id, $plan_id){
    $error = false;
    $sql = "SELECT regist_id FROM registration WHERE user_user_id = $member_id AND plan_expired > NOW();";
    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res) > 0){
        $error = true;
    }

    return $error;
}


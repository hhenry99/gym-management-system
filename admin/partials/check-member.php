<?php
//Check member status on all pages
$sql = "SELECT user_id, status FROM user where role = 1";
$res = mysqli_query($conn, $sql);

if(mysqli_num_rows($res) > 0 ){
    while($row = mysqli_fetch_assoc($res)){
        $id = $row['user_id'];
        $status = $row['status'];
        if($status == 1){
            $active = false;   
            //query to check and see if the user has a class or a plan that is not expired
            $sql2 = "SELECT regist_id FROM registration WHERE user_user_id = $id AND (class_status = 1 OR plan_expired >= NOW());";
            $res2 = mysqli_query($conn, $sql2);

            if(mysqli_num_rows($res2) > 0){
                $active = true;
            }

            if($active == false){
                $sql3 = "UPDATE user SET status = 0 WHERE user_id = $id;";
                $res3 = mysqli_query($conn, $sql3);
            }
        }
    }
}

<?php 
include('config.php');

// if(isset($_POST['select'])){
//     $num = $_POST['select'];

//     if(isset($_POST['click'])){
//         echo "hello";
//     }
//     $sql = "SELECT * FROM user LIMIT $num";
//     $res = mysqli_query($conn, $sql);
//     $count = mysqli_num_rows($res);

//     if($count>0){
//         while($row = mysqli_fetch_assoc($res)){
//             echo "<br>".$row['name'];
//         }
//     }
    
//     $sql = "SELECT * FROM user";
//     $res = mysqli_query($conn, $sql);
//     $total = mysqli_num_rows($res);
//     echo '<br><br>Showing '.$count.' OF '.$total;

//     // echo "<button id = 'next'>Next</button>";

    
// }
if(isset($_POST['input'])){
    $input = $_POST['input'];
    $sql = "SELECT * FROM user WHERE name LIKE '$input%' LIMIT 5"; 
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
        while($row = mysqli_fetch_assoc($res)){
            echo "<br>".$row['name'];
        }
    } else {
        echo "No Data Found";
    }
}
if(isset($_POST['page'])){
    $start = $_POST['page'] * 2;

    $sql = "SELECT * FROM user LIMIT $start, 5";
    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res) > 0){
        while($row = mysqli_fetch_assoc($res)){
            echo "<br>".$row['name'];
        }
    }

}

?>
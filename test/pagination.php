<?php
include('config.php');

if(isset($_POST['input'])){
    $input = $_POST['input'];
    echo "<br>".$input;
} 

$record_per_page = 5;
$page = "";

$output = "";

if(isset($_POST['page'])){
    $page = $_POST['page'];
} else {
    $page = 1;
}

$start_from = ($page-1) * $record_per_page;
    
$sql = "SELECT * FROM user LIMIT $start_from, $record_per_page";
$res = mysqli_query($conn, $sql);

$output = "";
while($row = mysqli_fetch_assoc($res)){
    $output .= $row['name'].'<br>';
}

$page_query = "SELECT * FROM user";
$page_result = mysqli_query($conn, $page_query);
$total = mysqli_num_rows($page_result);

$total_pages = ceil($total / 5);

$output .= "<br>";
for($i = 1; $i<=$total_pages; $i++){
    $output .= "<span class = 'pagination_link' id ='".$i."' style ='cursor: pointer; background-color: gray; padding: 10px; margin-right: 10px;'>".$i."</span>";
}

echo $output; 




?>
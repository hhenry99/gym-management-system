<?php 
    include('partials/header.php');
?>

<?php
$trainerid = $_SESSION['user_id'];
$sql = "SELECT name FROM user WHERE user_id = $trainerid;";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
?>

<div class="main-content">
    <div class="header txt-center">
        <h1>Dashboard</h1>
        <p><?php if(isset($_SESSION['login'])){echo $_SESSION['login']; unset($_SESSION['login']);} ?>Welcome Back <?php echo $row['name'];?>!</p>
    </div>
    
    <div class="info">
        <h5>MY CLASSES:</h5>
        <?php
        $sql = "SELECT class_id, name FROM class where user_user_id = $trainerid;";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0 ){
            while($row = mysqli_fetch_assoc($res)){
                $classid = $row['class_id'];
                $name = $row['name'];

                $sql2 = "SELECT regist_id FROM registration WHERE class_class_id = $classid AND class_status = 1;";
                $res2 = mysqli_query($conn, $sql2);
                $enroll = mysqli_num_rows($res2);
            ?>
            <a href="class.php?id=<?php echo $classid;?>">
            <div class="box">
                <?php echo $name." Class Enrolled: ".$enroll;?>
            </div>
            </a>
            <?php
            }
        } else {
            echo "No class available";
        }
        ?>   
    </div>
</div>
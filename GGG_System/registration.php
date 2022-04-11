<?php 
include('partials/header.php'); 
?>

<div class="main-content">
    <div class="header txt-center">
        <h1>Registration</h1>
        <p>
        <?php
        $sql3 = "SELECT NOW();";
        $res3 = mysqli_query($conn, $sql3);
        $row3 = mysqli_fetch_assoc($res3);
        $time = $row3['NOW()'];
        echo $time;

        include('partials/session_check.php');
        ?>
        </p>


    </div>
    
    <div class="info">
        <a href="<?php echo SITEURL;?>crud/add-regist.php"><button class = "btn-primary">Sign Up</button></a>
        <table class = 'content-table'>
            <thead> 
                <tr>
                    <td>Regist ID</td>
                    <td>Member ID</td>
                    <td>Class ID</td>
                    <td>Class Status</td>
                    <td>Plan ID</td>
                    <td>Plan Start</td>
                    <td>Plan Expired</td>
                    <td>Actions</td>
                </tr>
            </thead>

            <tbody>
                <?php
                    $sql = "SELECT * FROM registration";
                    $res = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($res) > 0){
                        while($row = mysqli_fetch_assoc($res)){
                            $regist_id = $row['regist_id'];
                            $plan_expired = $row['plan_expired'];
                            $plan_start = $row['plan_start'];
                            $plan_id = $row['plan_plan_id'];
                            $user_id = $row['user_user_id'];
                            $class_id = $row['class_class_id'];
                            $class_status = $row['class_status'];
                            ?>
                            <tr>
                                <td><?php echo $regist_id;?></td>
                                <td><?php echo $user_id;?></td>
                                <td>
                                    <?php
                                    if($class_id != ""){
                                        echo $class_id;
                                    } else {
                                        echo "NA";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if($class_status != ""){
                                            if($class_status == 1){
                                                echo 'Active';
                                            } else {
                                                echo 'Inactive';
                                            }
                                        } else {
                                            echo "NA";
                                        }
                                    ?>
                                </td>
                                <td>
                                <?php
                                if($plan_id != ""){
                                    echo $plan_id;
                                } else {
                                    echo "NA";
                                }
                                ?>
                                </td>
                                <td>
                                <?php
                                if($plan_start != ""){
                                    echo $plan_start;
                                } else {
                                    echo "NA";
                                }
                                ?>
                                </td>
                                <td>
                                <?php 
                                if($plan_expired != ""){
                                    echo $plan_expired;
                                } else {
                                    echo "NA";
                                }
                                ?>
                                </td>
                                <td>
                                <!-- <a href="<?php echo SITEURL;?>crud/update-class.php?id=<?php echo $id;?>"><button class="btn-secondary"><i class="fa-solid fa-pen-to-square"></i></button></a> -->
                                <a href="<?php echo SITEURL;?>crud/delete-regist.php?id=<?php echo $regist_id;?>"><button class="btn-danger"><i class='fa-solid fa-x'></i></button></a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7">
                                No Data Found
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>

    </div>
</div>

<?php include('partials/footer.php'); ?>


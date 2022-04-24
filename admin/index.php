<?php include("partials/header.php");?>

<div class="main-content">
    <div class="header txt-center">
        <h1>DashBoard</h1> 
        <p>
            <?php
                if(isset($_SESSION['login'])) //login message
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['user'])) //display name
                {
                    echo "Welcome Back ".NAME."!";
                }
            ?>
        </p>
    </div>

    <?php
        //SQL for active/inactive member
        $sql = "SELECT COUNT(*) as total_member, (SELECT count(*) FROM user WHERE role = 1 AND status = 1) AS active_member, (SELECT count(*) FROM user WHERE status = 0 AND role = 1) AS inactive_member FROM user WHERE role = 1;";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $total_member = $row['total_member'];
        $total_active = $row['active_member'];
        $total_inactive = $row['inactive_member'];

        //invoice-revenue
        $sql = "SELECT SUM(amount) as 'total', SUM(amount_paid) as 'paid' FROM invoice;";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $revenue = $row['paid'];
        $notpaid = $row['total']-$revenue;

        //Registration

        //admin
        $sql = "SELECT user_id from user where role = 3 OR role = 4";
        $res = mysqli_query($conn, $sql);
        $admin_count = mysqli_num_rows($res);

        //trainer
        $sql = "SELECT user_id from user where role = 2";
        $res = mysqli_query($conn, $sql);
        $trainer_count = mysqli_num_rows($res);

        //class
        $sql = "SELECT class_id from class";
        $res = mysqli_query($conn, $sql);
        $class_count = mysqli_num_rows($res);
        $sql = "SELECT user_user_id FROM registration where class_status = 1";
        $res = mysqli_query($conn, $sql);
        $member_count = mysqli_num_rows($res);

        //equipment
        $sql = "SELECT count(equipment_id) AS 'equip_count', (SELECT count(equipment_id) FROM equipment WHERE cond = 'broken') as 'broken-equip' from equipment";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $equip_count = $row['equip_count'];
        $broken_equip = $row['broken-equip'];
    ?>

    <div class="info">
        <div class="box-wrapper txt-center">
            <a href="<?php echo SITEURL;?>manage-member.php">
                <div class="box color-1">
                    <h3>Total Member: <?php echo $total_member;?></h3>
                    <p>Active Member: <?php echo $total_active;?></p> 
                    <p>Inactive Member: <?php echo $total_inactive;?></p>
                </div>
            </a>
            <a href="<?php echo SITEURL;?>manage-invoice.php">
                <div class="box color-2">
                    <h3>Total Revenue: $<?php echo $revenue;?></h3>
                    <p>Not Paid: $<?php echo $notpaid;?>.00</p>
                </div>
            </a>
            <a href="<?php echo SITEURL;?>manage-admin.php">
                <div class="box color-3">
                    <h3>Total Admin: <?php echo $admin_count;?></h3>
                </div>
            </a>
            <a href="<?php echo SITEURL;?>manage-trainer.php">
                <div class="box color-4">
                    <h3>Total Trainer: <?php echo $trainer_count;?></h3>
                </div>
            </a>
            <a href="<?php echo SITEURL;?>manage-class.php">
                <div class="box color-5">
                    <h3>Total Class: <?php echo $class_count;?></h3>
                    <p>Member Enrolled: <?php echo $member_count;?></p>
                </div>
            </a>
            <a href="<?php echo SITEURL;?>manage-equipment.php">
                <div class="box color-6">
                    <h3>Total Equipment: <?php echo $equip_count;?></h3>
                    <p>Broken Equipments: <?php echo $broken_equip;?></p>
                </div>
            </a>
        </div>
        <hr>
    </div>
</div>

    
<?php include("partials/footer.php");?>
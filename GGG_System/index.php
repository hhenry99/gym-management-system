<?php include("partials/header.php");?>

<div class="main-content">
    <div class="header txt-center">
        <h1>--DashBoard--</h1>
        <p>
            <?php
                if(isset($_SESSION['login'])) //login message
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['user'])) //display name
                {
                    $username = $_SESSION['user'];
                    $sql = "SELECT name from admin WHERE username = '$username';";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($res);
                    echo "Welcome Back ".$row['name']."!";
                }
            ?>
        </p>
    </div>

    <?php
        //SQL for active/inactive member
        $sql = "SELECT COUNT(*) as total_member, (SELECT count(*) FROM member WHERE member_status = 'Active') AS active_member, (SELECT count(*) FROM member WHERE member_status = 'Inactive') AS inactive_member FROM member;";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $total_member = $row['total_member'];
        $total_active = $row['active_member'];
        $total_inactive = $row['inactive_member'];

        //invoice-revenue
        $sql = "SELECT SUM(amount) as 'total', SUM(amount_paid) as 'paid' FROM invoice;";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $revenue = $row['total'];
        $paid = $row['paid'];
        $notpaid = $revenue-$paid;

        //admin
        $sql = "SELECT admin_id from admin";
        $res = mysqli_query($conn, $sql);
        $admin_count = mysqli_num_rows($res);

        //trainer
        $sql = "SELECT trainer_id from trainer";
        $res = mysqli_query($conn, $sql);
        $trainer_count = mysqli_num_rows($res);

        //class
        $sql = "SELECT class_id from class";
        $res = mysqli_query($conn, $sql);
        $class_count = mysqli_num_rows($res);
        $sql = "SELECT member_member_id FROM member_has_class";
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
                    <p>Total Paid: $<?php echo $paid;?></p>
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
        <div class="div">
            <a href="test.php">Test</a>
        </div>
    </div>
</div>

    
<?php include("partials/footer.php");?>
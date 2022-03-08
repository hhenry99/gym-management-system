<?php include("partials/header.php");?>

        <div class="main-content">
            <div class="header">
                <h1>Dashboard</h1>
                <p>
                    <?php
                        if(isset($_SESSION['login']))
                        {
                            echo $_SESSION['login'];
                            unset($_SESSION['login']);
                        }
                        if(isset($_SESSION['user']))
                        {
                            echo "Hello ".$_SESSION['user'];
                        }
                    ?>
                </p>
            </div>

            <?php
                // $sql = "SELECT COUNT(*) FROM member;";
                // $res = mysqli_query($conn, $sql);
                // $row = mysqli_fetch_assoc($res);
                // $total = $row['COUNT(*)'];

                // $sql2 = "SELECT COUNT(*) FROM member WHERE member_status = 'Active';";
                // $res2 = mysqli_query($conn, $sql2);
                // $row = mysqli_fetch_assoc($res2);
                // $total_active = $row['COUNT(*)'];

                $sql = "SELECT COUNT(*) as total_member, (SELECT count(*) FROM member WHERE member_status = 'Active') AS active_member, (SELECT count(*) FROM member WHERE member_status = 'Inactive') AS inactive_member FROM member;";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($res);
                $total_member = $row['total_member'];
                $total_active = $row['active_member'];
                $total_inactive = $row['inactive_member'];
            ?>
            <div class="box color-1">
                <h3>Total Members: <?php echo $total_member;?></h3>
                <p>Active Members: <?php echo $total_active;?></p> 
                <p>Inactive Members: <?php echo $total_inactive;?></p>
            </div>
            <div class="box color-1">
                <h3>Total Revenue: </h3>
                <p>Total Paid:</p>
                <p>Not Paid: </p>
            </div>
            <div class="box color-1">
                <h3>Total Admin:</h3>
                <br>
                <br>
            </div>
            <div class="box color-1">
                <h3>Total Trainer</h3>
            </div>
            <div class="box color-1">
                <h3>Total Class</h3>
            </div>
            <div class="box color-1">
                <h3>Total Equipment</h3>
            </div>

        </div>

        
<?php include("partials/footer.php");?>
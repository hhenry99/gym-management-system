<?php require_once('partials/header.php');?>
<div class="main-content">
    <div class="header">
        <h1 class ="txt-center">Manage Member</h1>
        <p>
            <?php
                include('partials/session_check.php');
            ?>

            <?php
                $sql3 = "SELECT NOW();";
                $res3 = mysqli_query($conn, $sql3);
                $row3 = mysqli_fetch_assoc($res3);
                $time = $row3['NOW()'];
                echo $time;
            ?>
        </p>
    </div>

    <div class="info">
        <a href="<?php echo SITEURL?>crud/add-member.php"><button class="btn-primary">Add Member</button></a>
        <form action="<?php echo SITEURL?>crud/search-member.php" method="POST">
            <input type="text" name="search" placeholder="Enter NAME or ID">
            <input type="submit" value="search" name = "submit-search">
        </form>

        <table class="content-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Expired</th>
                    <th>Plan</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <?php
               /* $sql = "SELECT * FROM member";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count > 0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['member_id'];
                        $image = $row['image_name'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $phone = $row['phone'];
                        $emergency = $row['emergency_contact'];
                        $join = $row['date_join'];
                        $expired = $row['date_expired'];
                        $status = $row['member_status'];
                        $plan_id = $row['plan_plan_id'];
                        
                        if($time >= $expired){
                            $sql2 = "UPDATE member set member_status = 'Inactive', date_expired = NULL where member_id = $id;";
                            $res2 = mysqli_query($conn, $sql2);
                            $status = 'Inactive';
                        }

                        ?>
                            <tr>
                                <td><?php echo $id?></td>
                                <td>
                                    <?php 
                                        if($image != "")
                                        {
                                            ?>
                                            <img src="<?php echo SITEURL?>images/member/<?php echo $image?>" width = "100px" height = "100px" class = "round">
                                            <?php
                                        }
                                        else
                                        {
                                            echo "No image available";
                                        }
                                    ?>
                                </td>
                                <td><?php echo $name?></td>
                                <td><?php echo $email?></td>
                                <td><?php echo $phone?></td>
                                <td><?php echo $emergency?></td>
                                <td><?php echo $join?></td>
                                <td><?php echo $expired;?></td>
                                <td>
                                    <?php
                                    if($plan_id != ""){
                                        $sql2 = "SELECT name from plan WHERE plan_id = $plan_id";

                                        $res2 = mysqli_query($conn, $sql2);
    
                                        $row2 = mysqli_fetch_assoc($res2);
    
                                        echo $row2['name'];    
                                    }
                                    else {
                                        echo "NONE";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $status?></td>
                                <td>
                                    <a href="<?php echo SITEURL?>crud/update-member.php?id=<?php echo $id?>"><button class="btn-secondary">Update</button></a> 
                                    <a href="<?php echo SITEURL?>crud/delete-member.php?id=<?php echo $id?>&image_name=<?php echo $image?>"><button class="btn-danger">Delete</button></a>
                                </td>
                            </tr>
                        <?php
                    }
                }
                else
                {
                    ?>
                        <tr>
                            <td colspan = "10" class = "txt-center">no members found</td>
                        </tr>
                    <?php
                }*/
            ?>
        </table>
    </div>
</div>

<?php require_once("partials/footer.php");?>
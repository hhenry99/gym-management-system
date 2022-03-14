<?php require_once('partials/header.php');?>
<div class="main-content">
    <div class="header">
        <h1 class ="txt-center">Manage Member</h1>
        <p>
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
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
        <form action="">
            <input type="search" name="search">
            <input type="submit" value="submit">
        </form>

        <table class="tbl-full txt-left">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Emergency Contact</th>
                <th>Join Date</th>
                <th>Expired</th>
                <th>Plan</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php
                $sql = "SELECT * FROM member";
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
                            $sql2 = "UPDATE member set member_status = 'Inactive' where member_id = $id;";
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
                                    $sql2 = "SELECT name from plan WHERE plan_id = $plan_id";

                                    $res2 = mysqli_query($conn, $sql2);

                                    $row2 = mysqli_fetch_assoc($res2);

                                    echo $row2['name'];                                    
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
                }
            ?>
        </table>
    </div>
</div>

<?php require_once("partials/footer.php");?>
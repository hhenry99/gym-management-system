<?php include('../partials/crud-header.php');?>

<script>
    if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
    }
</script>

<div class="main-content">
    <div class="header">
        <h1>Manage Member</h1>
    </div>

    <div class="info">
    <?php
    if(isset($_POST['submit-search'])){
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT * FROM member WHERE member_id LIKE '%$search%' OR name LIKE '%$search%';";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count > 0){
            echo "<strong>".$count." result found!</strong><br>";
            ?>
            <table class="tbl-full">
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
                    while($row = mysqli_fetch_assoc($res)){
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
                ?>
            </table>
            <?php
        }
        else{
            echo "No Member Found :C <a href = ".SITEURL."manage-member.php>Go Back?</a>";
        }
        
    }
    else{
        header('location:'.SITEURL.'manage-member.php');
    }
    ?>
    </div>
</div>


<?php include('../partials/crud-footer.php');?>

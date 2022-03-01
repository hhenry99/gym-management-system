<?php include('partials/header.php');?>

<div class="main-content">
            <div class="header">
                <h1 class = "txt-center">Manage Class</h1>
                <p class = "txt-center">
                    <?php include('partials/session_check.php');?>
                </p>
            </div>

            <div class="info">
                <div class="btn-container">
                    <a href="<?php echo SITEURL;?>crud/add-class.php"><button class = "btn-primary">Add Class</button></a>
                    <!-- <a href="<?php echo SITEURL;?>manage-class-view.php"><button class = "btn-primary">View Class</button></a> -->
                </div>
                <table class = "tbl-full txt-left">
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Start/End</th>
                        <th>Cost</th>
                        <th>Trainer</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM class";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        
                        if($count>0)
                        {
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $id = $row['class_id'];
                                $name = $row['name'];
                                $desc = $row['description'];
                                $location = $row['location'];
                                $start = $row['start_end'];
                                $cost = $row['cost'];
                                $trainer_id = $row['trainer_trainer_id'];
                                ?>
                                <tr>
                                    <td><?php echo $name;?></td>
                                    <td><?php echo $desc;?></td>
                                    <td><?php echo $location;?></td>
                                    <td><?php echo $start;?></td>
                                    <td>$<?php echo $cost;?></td>
                                    <td>
                                        <?php
                                            $sql2 = "SELECT name FROM trainer where trainer_id = $trainer_id";
                                            $res2 = mysqli_query($conn,$sql2);
                                            
                                            $row = mysqli_fetch_assoc($res2);
                                            $trainer_name = $row['name'];
                                            
                                            echo $trainer_name;
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>crud/class-roster.php?id=<?php echo $id;?>"><button class = "btn-primary">Class Roster</button></a>
                                        <a href="<?php echo SITEURL;?>crud/update-class.php?id=<?php echo $id;?>"><button class="btn-secondary pad-1">Update</button></a>
                                        <a href="<?php echo SITEURL;?>crud/delete-class.php?id=<?php echo $id;?>"><button class="btn-danger pad-1">Delete</button></a>
                                    </td>
     
                                </tr>
                                <?php
                            }

                        }
                        else
                        {
                            ?>
                            <tr>
                              <td colspan="7">No Classes Available</td>  
                            </tr>
                            <?php
                        }
                    ?>
                </table>
            </div>
        </div>

<?php include('partials/footer.php');?>
<?php

include('../config/constant.php');
include('../partials/login-check.php');

if(isset($_POST['input'])){
    $input = $_POST['input'];
    ?>
    <table class = "content-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>Start/End</th>
                <th>Cost</th>
                <th>Trainer</th>
                <th>Enrolled</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $sql = "SELECT * FROM class WHERE class_id LIKE '$input%' OR name LIKE '$input%' OR description LIKE '%$input%' ";
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
                    $trainer_id = $row['user_user_id'];
                    ?>
                    <tr>
                        <td><?php echo $id;?></td>
                        <td><?php echo $name;?></td>
                        <td><?php echo $desc;?></td>
                        <td><?php echo $location;?></td>
                        <td><?php echo $start;?></td>
                        <td>$<?php echo $cost;?></td>
                        <td>
                            <?php
                            if($trainer_id != 0){
                                $sql2 = "SELECT name FROM user where user_id = $trainer_id";
                                $res2 = mysqli_query($conn,$sql2);
                                
                                $row = mysqli_fetch_assoc($res2);
                                $trainer_name = $row['name'];
                                
                                echo $trainer_name;
                            } else {
                                echo "No Trainer";
                            }
    
                            ?>
                        </td>
                        <td>
                            <?php 
                            $sql3 = "SELECT regist_id FROM registration WHERE class_class_id = $id AND class_status = 1";
                            $res3 = mysqli_query($conn, $sql3);
                            
                            echo mysqli_num_rows($res3);
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo SITEURL;?>crud/class-roster.php?id=<?php echo $id;?>"><button class = "btn-primary"><i class="fa-solid fa-user-large" style = 'color: white; font-size: 1.5em;'></i></a>
                            <a href="<?php echo SITEURL;?>crud/update-class.php?id=<?php echo $id;?>"><button class="btn-secondary"><i class="fa-solid fa-pen-to-square"></i></button></a>
                            <a href="<?php echo SITEURL;?>crud/delete-class.php?id=<?php echo $id;?>"><button class="btn-danger"><i class='fa-solid fa-x'></i></button></a>
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
        </tbody>
    </table>
    <?php
}

mysqli_close($conn);
<?php

include('../config/constant.php');
include('../partials/login-check.php');

if(isset($_POST['input'])){
    $input = $_POST['input'];
    ?>
        <table class="content-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Duration</th>
                    <th>Cost</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php
                $sql = "SELECT * FROM plan WHERE plan_id LIKE '$input%' OR name LIKE '$input%' OR description LIKE '$input%'";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                if($count > 0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['plan_id'];
                        $name = $row['name'];
                        $des = $row['description'];
                        $duration = $row['duration'];
                        $cost = $row['cost'];
                        ?>
                        <tr>
                            <td><?php echo $id;?></td>
                            <td><?php echo $name;?></td>
                            <td><?php echo $des;?></td>
                            <td><?php echo $duration;?> Month</td>
                            <td>$<?php echo $cost;?></td>
                            <td>
                            <a href="<?php echo SITEURL;?>crud/update-plan.php?id=<?php echo $id;?>"><button class = "btn-secondary pad-1"><i class="fa-solid fa-pen-to-square"></i></button></a>
                            <a href="<?php echo SITEURL;?>crud/delete-plan.php?id=<?php echo $id;?>"><button class = "btn-danger pad-1"><i class='fa-solid fa-x'></i></button></a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <td colspan = '6'>No Plan Found</td>
                    <?php
                }
            ?>
            </tbody>
        </table>
    <?php
}

mysqli_close($conn);
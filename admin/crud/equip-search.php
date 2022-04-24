<?php

include('../config/constant.php');
include('../partials/login-check.php');

if(isset($_POST['input'])){
    $input = $_POST['input'];
    ?>
    <table class = "content-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Condition</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php
            $sql = "SELECT * FROM equipment WHERE (num LIKE '$input%' OR name LIKE '$input%' OR cond LIKE '$input%') ORDER BY num, name;";
            
            $res = mysqli_query($conn,$sql);
            
            $count = mysqli_num_rows($res);

            if($count > 0)
            {
                while($row = mysqli_fetch_assoc($res))
                {
                    $num = $row['num'];
                    $id = $row['equipment_id'];
                    $name = $row['name'];
                    $condition = $row['cond'];
                    
                    ?>
                        <tr>
                            <td><?php echo $num;?></td>
                            <td><?php echo $name;?></td>
                            <td><?php echo $condition;?></td>
                            <td>
                                <a href="<?php echo SITEURL?>crud/update-equip.php?id=<?php echo $id?>"><button class = "btn-secondary"><i class="fa-solid fa-pen-to-square"></i></button></a>
                                <a href="<?php echo SITEURL?>crud/delete-equip.php?id=<?php echo $id?>"><button class = "btn-danger"><i class='fa-solid fa-x'></i></button></a>
                            </td>
                        </tr>
                    <?php
                }
            }
            else
            {
                ?>
                    <tr>
                        <td colspan = "4">No equipments found.</td>
                    </tr>
                <?php
            }
        ?>
        </tbody>
    </table>

    <?php
}

mysqli_close($conn);
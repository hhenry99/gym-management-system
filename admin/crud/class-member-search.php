<?php

include('../config/constant.php');
include('../partials/login-check.php');

if(isset($_POST['input']) AND isset($_POST['id'])){
    $input = $_POST['input'];
    $class_id = $_POST['id'];

    ?>
    <table class = "content-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php 
            $sql3 = "SELECT user_id, name, email, phone
                    FROM user JOIN registration
                        ON user_user_id = user_id
                    WHERE class_class_id = $class_id AND class_status = 1 AND (user_id LIKE '$input%' OR name LIKE '$input%' OR email LIKE '$input%' OR phone LIKE '$input%')";
            $res3 = mysqli_query($conn, $sql3);
            $count = mysqli_num_rows($res3);

            if($count > 0){
                while($row = mysqli_fetch_assoc($res3))
                {
                    $member_id = $row['user_id'];
                    $name = $row['name'];
                    $email = $row['email'];
                    $phone = $row['phone'];
                    ?>
                    <tr>
                        <td><?php echo $member_id;?></td>
                        <td><?php echo $name;?></td>
                        <td><?php echo $email;?></td>
                        <td><?php echo $phone;?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>crud/delete-member-class.php?memberid=<?php echo $member_id;?>&classid=<?php echo $class_id;?>"><button class="btn-danger"><i class='fa-solid fa-x'></i></button></a>
                        </td>
                    </tr>
                    <?php
                } 
            }
            else
            {
                ?>
                    <tr>
                        <td colspan = "4">No Data Found</td>
                    </tr>
                <?php
            } 
        ?>
        </tbody>
    </table>
    <?php
}
mysqli_close($conn);
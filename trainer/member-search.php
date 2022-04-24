<?php

include('config/constant.php');
include('partials/login-check.php');

if(isset($_POST['input']) AND isset($_POST['id'])){
    $input = $_POST['input'];
    $classid = $_POST['id'];

    ?>
    <table class = 'content-tbl'>
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Actions</th>
        </thead>

        <tbody>
            <?php
            $sql = "SELECT user_id, name, phone, email FROM registration JOIN user ON user_user_id = user_id WHERE class_class_id = $classid AND class_status = 1 AND
            (user_id LIKE '$input%' OR name LIKE '$input%' OR phone LIKE '$input%' OR  email LIKE '$input%');";
            $res = mysqli_query($conn, $sql);
            if(mysqli_num_rows($res) > 0){
                while($row = mysqli_fetch_assoc($res)){
                    $user_id = $row['user_id'];
                    $name = $row['name'];
                    $phone = $row['phone'];
                    $email = $row['email'];
                    ?>
                    <tr>
                        <td><?php echo $user_id;?></td>
                        <td><?php echo $name;?></td>
                        <td><?php echo $phone;?></td>
                        <td><?php echo $email;?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>trainer/delete-member.php?memberid=<?php echo $user_id;?>&classid=<?php echo $classid;?>"><button class="btn-danger"><i class='fa-solid fa-x'></i></button></a>
                        </td>   
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan ="4">No member enrolled</td>
                </tr>
                <?php
            }
            ?>

        </tbody>
    </table>
    <?php
}
mysqli_close($conn);
?>
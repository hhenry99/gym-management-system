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
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $sql = "SELECT * FROM user WHERE role = 3 OR role = 4 AND (user_id LIKE '$input%' OR name LIKE '$input%' OR email LIKE '$input%')";
            $res = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($res);

            if($count > 0)
            {
                while($row = mysqli_fetch_assoc($res))
                {
                    $uid = $row['user_id'];
                    $image_name = $row['image_name'];
                    $name = $row['name'];
                    $role = $row['role'];
                    $email = $row['email'];
                    ?>
                    <tr>
                        <td><?php echo $uid;?>.</td>
                        <td>
                            <?php
                            if($image_name == "")
                            {
                                echo "<p class = 'txt-red'>No image available</p>";
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo SITEURL;?>images/admin/<?php echo $image_name;?>" width = "50px" height = "50px">
                                <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $name;?></td>
                        <td><?php echo $email;?></td>
                        <td>
                            <?php 
                            if($role == 3){
                                echo "Admin";
                            } else{
                                echo "Head Admin";
                            }
                            ?>
                        </td>
                        <td>    
                            <a href="<?php echo SITEURL;?>crud/update-admin.php?uid=<?php echo $uid;?>"><button class="btn-secondary"><i class="fa-solid fa-pen-to-square"></i></button></a>
                            <?php
                            //Prevents current admin from deleting itself.
                            if(ID != $uid){
                                $site = SITEURL;
                                echo "<a href='{$site}crud/delete-admin.php?uid={$uid}&image_name={$image_name}'><button class='btn-danger'><i class='fa-solid fa-x'></i></button></a>";
                            }
                            ?>
                        </td>
                    </tr>   
                    <?php
                }
            }
            else
            {
                ?>
                    <tr>
                        <td colspan="5">No admin found</td>
                    </tr>
                <?php
            } 
        ?>
        </tbody>
    </table>

    <?php
}

mysqli_close($conn);
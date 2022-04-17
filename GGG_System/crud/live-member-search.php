<?php
include('../config/constant.php');

if(isset($_POST['input'])){
    $input = $_POST['input'];
    ?>
    <table class="content-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <?php
        $sql = "SELECT * FROM user WHERE role = 1 AND (name LIKE '$input%' OR user_id like '$input%' OR email like '$input%' 
                                                        OR phone like '$input%')";
        $res = mysqli_query($conn, $sql);

        if(mysqli_num_rows($res) > 0)
        {
            while($row = mysqli_fetch_assoc($res))
            {
                $id = $row['user_id'];
                $image = $row['image_name'];
                $name = $row['name'];
                $email = $row['email'];
                $phone = $row['phone'];
                $status = $row['status'];
                ?>
                    <tr>
                        <td><?php echo $id?>.</td>
                        <td>
                            <?php 
                                if($image != "")
                                {
                                    ?>
                                    <img src="<?php echo SITEURL?>images/member/<?php echo $image?>" width = "75px" height = "75px">
                                    <?php
                                }
                                else
                                {
                                    echo "<span class = 'txt-red'>No image available</span>";
                                }
                            ?>
                        </td>
                        <td><?php echo $name?></td>
                        <td><?php echo $email?></td>
                        <td><?php echo $phone?></td>
                        <td>
                            <?php                 
                            if($status == 1){
                                $active = false;   
                                $sql2 = "SELECT regist_id, class_status, plan_expired FROM registration WHERE user_user_id = $id HAVING class_status = 1 OR plan_expired >= NOW();";
                                $res2 = mysqli_query($conn, $sql2);

                                if(mysqli_num_rows($res2) > 0){
                                    $active = true;
                                }

                                if($active == true){
                                    echo "Active";
                                } else {
                                    $sql3 = "UPDATE user SET status = 0 WHERE user_id = $id;";
                                    $res3 = mysqli_query($conn, $sql3);
                                    echo "Inactive";
                                }
                            } else {
                                echo "Inactive";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo SITEURL?>crud/update-member.php?id=<?php echo $id?>"><button class="btn-secondary"><i class="fa-solid fa-pen-to-square"></i></button></a> 
                            <a href="<?php echo SITEURL?>crud/delete-member.php?id=<?php echo $id?>&image_name=<?php echo $image?>"><button class="btn-danger"><i class='fa-solid fa-x'></i></button></a>
                        </td>
                    </tr>
                <?php
            }
        }
        else
        {
            ?>
                <tr>
                    <td colspan = "6">No Data Found</td>
                </tr>   
            <?php
        }
    ?>
</table>
<?php
}

include('../config/close-connection.php');
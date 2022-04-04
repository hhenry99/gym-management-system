<?php

include('partials/header.php');

if(ROLE != 4){
    header('location:'.SITEURL.'index.php');
}

?>

<div class="main-content">
    <div class="header txt-center">
        <h1>Admin</h1>
        <br>
        <?php
        include("partials/session_check.php");
        ?>
    </div>

    <div class="info">
    <a href="crud/add-admin.php"><button class = "btn-primary">Add Admin</button></a>
    <table class = "content-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $sql = "SELECT * FROM user WHERE role = 3 OR role = 4";
            $res = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($res);

            if($count > 0)
            {
                while($row = mysqli_fetch_assoc($res))
                {
                    $uid = $row['user_id'];
                    $image_name = $row['image_name'];
                    $name = $row['name'];
                    // $username = $row['username'];
                    // $password = $row['password'];
                    $role = $row['role'];
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
                                <img src="<?php echo SITEURL;?>images/admin/<?php echo $image_name;?>" width = "75px" height = "75px">
                                <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $name;?></td>
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
    </div>
   
</div>

<?php include("partials/footer.php");?>
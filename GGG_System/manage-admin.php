<?php include('partials/header.php');?>

<?php
$suid = $_SESSION['user'];
$sql = "SELECT role from user WHERE user_id = $suid;";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$urole = $row['role'];

if($urole == 3){
    header('location:'.SITEURL.'index.php');
}
?>

<div class="main-content">
    <div class="header txt-center">
        <h1>Manage Admin</h1>
        <br>
        <?php
        include("partials/session_check.php");
        ?>
    </div>

    <div class="info">
    <a href="crud/add-admin.php"><button class = "btn-primary">Add Admin</button></a>
    <table class = "tbl-full txt-left">
        <tr>
            <th>AdminID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php 
            $sql = "SELECT * FROM user JOIN admin ON user_id = user_user_id;";
            $res = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($res);

            if($count > 0)
            {
                while($row = mysqli_fetch_assoc($res))
                {
                    $aid = $row['admin_id'];
                    $image_name = $row['image_name'];
                    $name = $row['name'];
                    $username = $row['username'];
                    $password = $row['password'];
                    $role = $row['role'];
                    $uid = $row['user_user_id'];
                    ?>
                    <tr>
                        <td><?php echo $aid;?></td>
                        <td>
                            <?php
                            if($image_name == "")
                            {
                                echo "No image available";
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo SITEURL;?>images/admin/<?php echo $image_name;?>" width = "100px" height = "100px" class = "round">
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
                            <a href="<?php echo SITEURL;?>crud/update-admin.php?aid=<?php echo $aid;?>&uid=<?php echo $uid;?>"><button class="btn-secondary pad-1">Update</button></a>
                            <?php
                            //Prevents current admin from deleting itself.
                            if($suid != $uid){
                                $site = SITEURL;
                                echo "<a href='{$site}crud/delete-admin.php?aid={$aid}&uid={$uid}&image_name={$image_name}'><button class='btn-danger pad-1'>Delete</button></a>";
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
    </table>
    </div>
   
</div>

<?php include("partials/footer.php");?>
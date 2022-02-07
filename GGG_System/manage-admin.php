<?php include('partials/header.php');?>


<div class="main-content">
    <div class="header">
        <h2 class = "txt-center">Manage Admin</h2>
    </div>

    <div class="info">
        <button class = "btn-primary"><a href="add-admin.php">Add Admin</a></button>

        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

    <table class = "tbl-full txt-left">
        <tr>
            <th>AdminID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Username</th>
            <th>Actions</th>
        </tr>
        <?php

            $sql = "SELECT * FROM admin";

            $res = mysqli_query($conn,$sql);

            $count = mysqli_num_rows($res);

            if($count > 0)
            {
                while($row = mysqli_fetch_assoc($res))
                {
                    $id = $row['admin_id'];
                    $photo = $row['image_name'];
                    $admin_name = $row['admin_name'];
                    $username = $row['username'];
                    $password = $row['password'];

                    ?>
                    <tr>
                        <td><?php echo $id;?></td>
                        <td>
                            <?php
                            if($photo == "")
                            {
                                echo "No image available";
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo SITEURL;?>images/admin/<?php echo $photo;?>" width = "100px">
                                <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $admin_name;?></td>
                        <td><?php echo $username?></td>
                        <td>
                            <button class="btn-secondary"><a href="<?php echo SITEURL;?>update-admin.php?id=<?php echo $id;?>">Update</a></button>
                            <button class="btn-danger"><a href="<?php echo SITEURL;?>delete-admin.php?id=<?php echo $id;?>">Delete</a></button>
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
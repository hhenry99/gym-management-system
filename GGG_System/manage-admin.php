<?php include('partials/header.php');?>


<div class="main-content">
    <div class="header">
        <h1 class = "txt-center">Manage Admin</h1>
    </div>

    <div class="info">
        <div class="">
            <a href="crud/add-admin.php"><button class = "btn-primary">Add Admin</button></a>
        </div>

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
        if(isset($_SESSION['remove']))
        {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
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
                    $image_name = $row['image_name'];
                    $name = $row['name'];
                    $username = $row['username'];
                    $password = $row['password'];

                    ?>
                    <tr>
                        <td><?php echo $id;?></td>
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
                        <td><?php echo $username?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>crud/update-admin.php?id=<?php echo $id;?>"><button class="btn-secondary pad-1">Update</button></a>
                            <a href="<?php echo SITEURL;?>crud/delete-admin.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>"><button class="btn-danger pad-1">Delete</button></a>
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
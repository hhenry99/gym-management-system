<?php require_once('partials/header.php');?>
<div class="main-content">
    <div class="header txt-center">
        <h1>Member</h1>
        <p>
            <?php
                include('partials/session_check.php');
            ?>
        </p>
            <?php
                // $sql3 = "SELECT NOW();";
                // $res3 = mysqli_query($conn, $sql3);
                // $row3 = mysqli_fetch_assoc($res3);
                // $time = $row3['NOW()'];
                // echo $time;
            ?>
    </div>

    <div class="info">
        <a href="<?php echo SITEURL?>crud/add-member.php"><button class="btn-primary">Add Member</button></a>
        <form action="<?php echo SITEURL?>crud/search-member.php" method="POST">
            <input type="text" name="search" placeholder="Enter NAME or ID">
            <input type="submit" value="search" name = "submit-search">
        </form>

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
                $sql = "SELECT * FROM user WHERE role = 1";
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
                                    if($status == 0){
                                        echo "Inactive";
                                    } else {
                                        echo "Active";
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
                            <td colspan = "6" class = "txt-center"><span class = 'txt-red'>No Members Found</span></td>
                        </tr>
                    <?php
                }
            ?>
        </table>
    </div>
</div>

<?php require_once("partials/footer.php");?>
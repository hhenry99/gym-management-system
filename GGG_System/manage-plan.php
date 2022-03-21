<?php include('partials/header.php');?>


<div class="main-content">
    <div class="header txt-center">
        <h1>Manage Plan</h1>
        <p>
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
            if(isset($_SESSION['not-found']))
            {
                echo $_SESSION['not-found'];
                unset($_SESSION['not-found']);
            }
            ?>
        </p>
    </div>

    <div class="info">
    <a href="<?php echo SITEURL;?>crud/add-plan.php"><button class = "btn-primary">Add Plan</button></a>
        <table class="tbl-full txt-left">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Duration</th>
                <th>Cost</th>
                <th>Actions</th>
            </tr>
            <?php
                $sql = "SELECT * FROM plan;";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                if($count > 0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['plan_id'];
                        $name = $row['name'];
                        $des = $row['description'];
                        $duration = $row['duration'];
                        $cost = $row['cost'];
                        ?>
                        <tr>
                            <td><?php echo $name;?></td>
                            <td><?php echo $des;?></td>
                            <td><?php echo $duration;?> Month</td>
                            <td>$<?php echo $cost;?></td>
                            <td>
                            <?php if ($id != 1) { ?>
                                <a href="<?php echo SITEURL;?>crud/update-plan.php?id=<?php echo $id;?>"><button class = "btn-secondary pad-1">Update</button></a>
                                <a href="<?php echo SITEURL;?>crud/delete-plan.php?id=<?php echo $id;?>"><button class = "btn-danger pad-1">Delete</button></a>
                            <?php
                            }
                            else{
                                echo "No Actions";
                            }
                            ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
            ?>
        </table>
    </div>
</div>

<?php include("partials/footer.php");?>
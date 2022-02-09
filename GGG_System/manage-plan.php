<?php include('partials/header.php');?>


<div class="main-content">
    <div class="header">
        <h1 class = "txt-center">Manage Plan</h1>
        <p class = "txt-center">
            <?php  
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            ?>
        </p>
    </div>

    <div class="info">
    <a href="<?php echo SITEURL;?>add-plan.php"><button class = "btn-primary">Add Plan</button></a>
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
                            <td><?php echo $duration;?></td>
                            <td><?php echo $cost;?></td>
                            <td>
                                <a href="<?php echo SITEURL;?>update-plan.php"><button class = "btn-secondary pad-1">Update</button></a>
                                <a href="<?php echo SITEURL;?>delete-plan.php"><button class = "btn-danger pad-1">Delete</button></a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <tr>
                        <td colspan = "5">No Data Found</td>
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>

    
</div>

<?php include("partials/footer.php");?>
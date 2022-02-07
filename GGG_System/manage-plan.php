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
        <button class = "btn-primary"><a href="<?php echo SITEURL;?>add-plan.php">Add Plan</a></button>
        <form action="" method = "POST">
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
                            $name = $row['plan_name'];
                            $des = $row['plan_description'];
                            $duration = $row['plan_duration'];
                            $cost = $row['plan_cost'];
                            ?>
                            <tr>
                                <td><?php echo $name;?></td>
                                <td><?php echo $des;?></td>
                                <td><?php echo $duration;?></td>
                                <td><?php echo $cost;?></td>
                                <td>
                                    Update
                                    Delete
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
        </form>
    </div>

    
</div>

<?php include("partials/footer.php");?>
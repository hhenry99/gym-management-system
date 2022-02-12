<?php include('partials/header.php');?>


    <div class="main-content">
        <div class="header">
            <h1 class = "txt-center">Manage Equipment</h1>
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
            <a href="<?php echo SITEURL;?>add-equip.php"><button class = "btn-primary">Add Equipment</button></a>
            <table class = "tbl-full txt-left">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Condition</th>
                    <th>Actions</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM equipment;";
                    
                    $res = mysqli_query($conn,$sql);
                    
                    $count = mysqli_num_rows($res);

                    if($count > 0)
                    {
                        while($row = mysqli_fetch_assoc($res))
                        {
                            $id = $row['equipment_id'];
                            $name = $row['name'];
                            $condition = $row['cond'];
                            
                            ?>
                                <tr>
                                    <td><?php echo $id;?></td>
                                    <td><?php echo $name;?></td>
                                    <td><?php echo $condition;?></td>
                                    <td>
                                        <a href="#"><button class = "btn-secondary">Update</button></a>
                                        <a href="#"><button class = "btn-danger">Delete</button></a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                            <tr>
                                <td colspan = "4">No equipments found</td>
                            </tr>
                        <?php
                    }
                ?>
            </table>
        </div>
    </div>

<?php include("partials/footer.php");?>
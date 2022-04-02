<?php require_once('partials/header.php');?>

<div class="main-content">
    <div class="header txt-center">
        <h1>Equipment</h1>
        <p>
            <?php include('partials/session_check.php');?>
        </p>
    </div>

    <div class="info">
        <a href="<?php echo SITEURL;?>crud/add-equip.php"><button class = "btn-primary">+ Equipment</button></a>
        <table class = "content-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Condition</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php
                $sql = "SELECT * FROM equipment ORDER BY num, name;";
                
                $res = mysqli_query($conn,$sql);
                
                $count = mysqli_num_rows($res);

                if($count > 0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $num = $row['num'];
                        $id = $row['equipment_id'];
                        $name = $row['name'];
                        $condition = $row['cond'];
                        
                        ?>
                            <tr>
                                <td><?php echo $num;?></td>
                                <td><?php echo $name;?></td>
                                <td><?php echo $condition;?></td>
                                <td>
                                    <a href="<?php echo SITEURL?>crud/update-equip.php?id=<?php echo $id?>"><button class = "btn-secondary"><i class="fa-solid fa-pen-to-square"></i></button></a>
                                    <a href="<?php echo SITEURL?>crud/delete-equip.php?id=<?php echo $id?>"><button class = "btn-danger"><i class='fa-solid fa-x'></i></button></a>
                                </td>
                            </tr>
                        <?php
                    }
                }
                else
                {
                    ?>
                        <tr>
                            <td colspan = "4">No equipments found.</td>
                        </tr>
                    <?php
                }
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once("partials/footer.php");?>
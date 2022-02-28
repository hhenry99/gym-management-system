<?php include('../partials/crud-header.php');?>


<div class="main-content">
    <div class="header">
        <h1 class = "txt-center">Update Plan</h1>
        <p>
            <?php
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
        </p>
    </div>

    <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                $sql = "SELECT * FROM plan WHERE plan_id = $id";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count == 1)
                {
                    $row = mysqli_fetch_assoc($res);

                    $name = $row['name'];
                    $description = $row['description'];
                    $duration = $row['duration'];
                    $cost = $row['cost'];
                }
                else
                {
                    header('location:'.SITEURL.'manage-plan.php');
                }
            }
            else
            {
                $_SESSION['not-found'] = "error plan not found";
                header('location:'.SITEURL.'manage-plan.php');
            }
    ?>

    <div class="info">
        <form action="" method="POST">
            <table class="tbl-30">

                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" value="<?php echo $name?>" required></td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description">
                            <?php echo $description?>
                        </textarea>
                    </td>
                </tr>

                <tr>
                    <td>duration</td>
                    <td>
                        <select name="duration">
                            <option value="1" <?php if($duration == 1){echo "selected";}?>>1 Month</option>
                            <option value="3" <?php if($duration == 3){echo "selected";}?>>3 Month</option>
                            <option value="12"<?php if($duration == 12){echo "selected";}?>>1 Year</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Cost</td>
                    <td><input type="number" name="cost" value="<?php echo $cost?>" required></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name = "submit" value="Update Plan" class = "btn-primary pad-1">
                    </td>
                </tr>
            </table>
        </form>
        
        <?php

            if(isset($_POST['submit']))
            {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $duration = $_POST['duration'];
                $cost = $_POST['cost'];

                $sql2 = "UPDATE plan SET
                        name = '$name',
                        description = '$description',
                        duration = '$duration',
                        cost = $cost
                        WHERE plan_id = $id
                        ";

                $res2 = mysqli_query($conn,$sql2);
                
                if($res2==true)
                {
                    $_SESSION['update'] = "Plan updated successfully";
                    header('location:'.SITEURL.'manage-plan.php');
                }
                else
                {
                    $_SESSION['update'] = "Fail to update";
                    header('location:'.SITEURL.'update-plan.php');
                }
            }

        ?>

    </div>

</div>

<?php include('../partials/crud-footer.php');?>
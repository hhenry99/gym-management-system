<?php require_once('../partials/crud-header.php');?>

<?php 
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM equipment WHERE equipment_id = $id";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            $row = mysqli_fetch_assoc($res);
            $name = $row['name'];
            $cond = $row['cond'];
        }
        else
        {
            header('location:'.SITEURL.'manage-equipment.php');
        }
    }
    else
    {
        header('location:'.SITEURL.'manage-equipment.php');
    }
?>


<div class="main-content">
    <div class="header">
        <h1 class ="txt-center">Update Equipment</h1>
        <p>
            <?php
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>

            <?php
                if(isset($_POST['submit']))
                {
                    $name = $_POST['name'];
                    $condition = $_POST['cond'];

                    $sql2 = "UPDATE equipment SET
                            name = '$name',
                            cond = '$condition'
                            WHERE equipment_id = $id;
                            ";
                    
                    $res2 = mysqli_query($conn, $sql2);

                    if($res2 == true)
                    {
                        $_SESSION['update'] = "Equipment updated";
                        header('location:'.SITEURL.'manage-equipment.php');
                    }
                    else
                    {
                        $_SESSION['update'] = "Fail to update";
                        header('location:'.SITEURL.'update-equip.php');
                    }
                    
                }
            ?>
            
        </p>
    </div>
    <div class="info">
        <form action="" method = "POST">
            <table class = "tbl-30">
                <tr>
                    <td>Name</td>
                    <td><input type="text" name = "name" value = "<?php echo $name;?>"></td>
                </tr>
                <tr>
                    <td>Condition</td>
                    <td>
                        <!-- <input type="text" name = "cond"> -->
                        <select name="cond">
                            <option value="good" <?php if($cond == "good"){echo "selected";}?>>Good</option>
                            <option value="dirty"<?php if($cond == "dirty"){echo "selected";}?>>Dirty</option>
                            <option value="broken" <?php if($cond == "broken"){echo "selected";}?>>Broken</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan = "2">
                        <input type="submit" value="Add Equip." class = "btn-primary" name = "submit">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php require_once('../partials/crud-footer.php');?>

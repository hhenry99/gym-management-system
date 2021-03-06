<?php include('../partials/crud-header.php');?>

<?php
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM class where class_id = $id";
        $res = mysqli_query($conn, $sql);

        if(mysqli_num_rows($res) == 1)
        {
            $row = mysqli_fetch_assoc($res);
            $name = $row['name'];
            $desc = $row['description'];
            $loc = $row['location'];
            $start_end = $row['start_end'];
            $cost = $row['cost'];
            $trainer_id = $row['user_user_id'];
        }
        else
        {
            header('location:'.SITEURL.'manage-class.php');
        }
    }
    else
    {
        header('location:'.SITEURL.'manage-class.php');
    }
?>

<?php
    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $desc = $_POST['description'];
        $loc = $_POST['location'];
        $startend = $_POST['startend'];
        $cost = $_POST['cost'];
        $trainer_id = $_POST['trainer'];

        $sql3 = "UPDATE class SET
                name = '$name',
                description = '$desc',
                location = '$loc',
                start_end = '$startend',
                cost = $cost,
                user_user_id = $trainer_id
                WHERE class_id = $id;
                ";
        $res3 = mysqli_query($conn, $sql3);

        if($res3 == true)
        {
            $_SESSION['update'] = "<br><span class = 'txt-green'>Class updated success!</span>";
            header('location:'.SITEURL.'manage-class.php');
        }
    }

?>
<div class="main-content">
    <div class="header txt-center">
        <h1>Add Class</h1>
    </div>

    <div class="info">
        <form action="" method = "POST">
            <table class="tbl-wrapper">
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" value = "<?php echo $name;?>"required></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" required>
                            <?php echo $desc;?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td>
                        <input type="text" name = "location" value = "<?php echo $loc;?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Start/End</td>
                    <td>
                        <textarea name="startend" required>
                            <?php echo $start_end;?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td>Cost</td>
                    <td><input type="number" name="cost" step = "0.01" value = "<?php echo $cost;?>" required></td>
                </tr>
                <tr>
                    <td>Trainer</td>
                    <td>
                        <select name="trainer">
                            <option value="NULL" <?php if($trainer_id == ""){echo "SELECTED";}?>>None</option>
                           <?php
                                $sql2 = "SELECT user_id, name FROM user WHERE role = 2";
                                $res2 = mysqli_query($conn, $sql2);

                                if(mysqli_num_rows($res2) > 0)
                                {
                                    while($row = mysqli_fetch_assoc($res2))
                                    {
                                        $t_id = $row['user_id'];
                                        $name = $row['name'];
                                        ?>
                                            <option value="<?php echo $t_id;?>" <?php if($trainer_id == $t_id){echo "SELECTED";}?>><?php echo $name;?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                ?>
                                <option value="0">No Trainer Available</option>
                                <?php
                                }
                            ?> 
                        </select>

                    </td>
                </tr>
                <tr>
                    <td>
                        <br>
                        <input type="submit" value="Submit" name = "submit" class = "btn-second">
                    </td>
                    <td>
                        <br>
                        <input type="button" value="Cancel" class = 'btn-cancel' onClick="document.location.href='<?php echo SITEURL;?>manage-class.php';">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('../partials/crud-footer.php');?>
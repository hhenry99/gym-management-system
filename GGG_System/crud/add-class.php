<?php include('../partials/crud-header.php');?>

<?php
    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $desc = $_POST['description'];
        $location = $_POST['location'];
        $start = $_POST['startend'];
        $cost = $_POST['cost'];
        $trainer_id = $_POST['trainer'];

        $sql2 = "INSERT INTO class SET
                name = '$name',
                description = '$desc',
                location = '$location',
                start_end = '$start',
                cost = $cost,
                trainer_trainer_id = $trainer_id;
                ";
        
        $res2 = mysqli_query($conn, $sql2);

        if($res2 == true)
        {
            $_SESSION['add-class'] = "Class Added Success!";
            header('location:'.SITEURL.'manage-class.php');
        }
    }
?>

<div class="main-content">
    <div class="header">
        <h1>Add Class</h1>
    </div>

    <div class="info">
        <form action="" method = "POST">
            <table class="tbl-30">
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" required></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td>
                        <input type="text" name = "location" required>
                    </td>
                </tr>
                <tr>
                    <td>Start/End</td>
                    <td>
                        <textarea name="startend" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Cost</td>
                    <td><input type="number" name="cost" step = "0.01" required></td>
                </tr>
                <tr>
                    <td>Trainer</td>
                    <td>
                        <select name="trainer">
                           <?php
                                $sql = "SELECT * FROM trainer";
                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);
                                if($count > 0)
                                {
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        $id = $row['trainer_id'];
                                        $name = $row['name'];
                                        ?>
                                            <option value="<?php echo $id;?>"><?php echo $name;?></option>
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
                    <td colspan="2">
                        <input type="submit" value="Submit" name ="submit" class = "btn-primary pad-1">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('../partials/crud-footer.php');?>
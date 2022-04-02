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
        $num = $row['num'];
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

<?php
if(isset($_POST['submit']))
{
    $number = $_POST['number'];
    $name = $_POST['name'];
    $condition = $_POST['cond'];

    $sql2 = "UPDATE equipment SET
            num = $number,
            name = '$name',
            cond = '$condition'
            WHERE equipment_id = $id;
            ";
    
    $res2 = mysqli_query($conn, $sql2);

    $_SESSION['update'] = "<br><span class='txt-green'>Equipment Updated!</span>";
    header('location:'.SITEURL.'manage-equipment.php');
}
?>

<div class="main-content">
    <div class="header">
        <h1 class ="txt-center">Update Equipment</h1>
    </div>
    <div class="info">
        <form action="" method = "POST">
            <table class = "tbl-wrapper">
                <tr>
                    <td>Number</td>
                    <td><input type="number" name="number" value="<?php echo $num;?>" required></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><input type="text" name = "name" value = "<?php echo $name;?>" required></td>
                </tr>
                <tr>
                    <td>Condition</td>
                    <td>
                        <!-- <input type="text" name = "cond"> -->
                        <select name="cond">
                            <option value="good" <?php if($cond == "good"){echo "selected";}?>>Good</option>
                            <option value="broken" <?php if($cond == "broken"){echo "selected";}?>>Broken</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan = "2">
                        <br>
                        <input type="submit" value="Save" class = "btn-primary pad-1" name = "submit">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php require_once('../partials/crud-footer.php');?>

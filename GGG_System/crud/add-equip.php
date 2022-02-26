<?php require_once('../partials/crud-header.php');?>

<div class="main-content">
    <div class="header">
        <h1 class = "txt-center">Equipment</h1>
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
        <form action="" method = "POST">
            <table class = "tbl-30">
                <tr>
                    <td>Name</td>
                    <td><input type="text" name = "name"></td>
                </tr>
                <tr>
                    <td>Condition</td>
                    <td>
                        <!-- <input type="text" name = "cond"> -->
                        <select name="cond">
                            <option value="good">Good</option>
                            <option value="dirty">Dirty</option>
                            <option value="broken">Broken</option>
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

        <?php
            if(isset($_POST['submit']))
            {
                $name = $_POST['name'];
                $cond = $_POST['cond'];

                $sql = "INSERT INTO equipment SET
                        name = '$name',
                        cond = '$cond';";

                $res = mysqli_query($conn,$sql);

                if($res == true)
                {
                    $_SESSION['add'] = "Equipment added successfully";
                    header('location:'.SITEURL.'manage-equipment.php');
                }
                else
                {
                    $_SESSION['add'] = "fail to add equipment";
                    header('location:'.SITEURL.'crud/add-equip.php');
                }
            }
        ?>
    </div>

</div>
<?php require_once('../partials/crud-footer.php');?>

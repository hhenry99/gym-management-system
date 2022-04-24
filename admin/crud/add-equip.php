<?php require_once('../partials/crud-header.php');?>

<div class="main-content">
    <div class="header txt-center">
        <h1>Equipment</h1>
    </div>

    <div class="info">
        <form action="" method = "POST">
            <table class = "tbl-wrapper">
                <tr>
                    <td>Number*</td>
                    <td><input type="number" name="number" required></td>
                </tr>
                <tr>
                    <td>Name*</td>
                    <td><input type="text" name = "name" required></td>
                </tr>
                <tr>
                    <td>Condition*</td>
                    <td>
                        <select name="cond">
                            <option value="good">Good</option>
                            <option value="broken">Broken</option>
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
                        <input type="button" value="Cancel" class = 'btn-cancel' onClick="document.location.href='<?php echo SITEURL;?>manage-equipment.php';">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_POST['submit'])){
                $name = $_POST['name'];
                $cond = $_POST['cond'];
                $number = $_POST['number'];

                $sql = "INSERT INTO equipment SET
                        num = $number,
                        name = '$name',
                        cond = '$cond';";

                $res = mysqli_query($conn,$sql);

                $_SESSION['add'] = "<br><span class = 'txt-green'>Equipment added successfully</span>";
                header('location:'.SITEURL.'manage-equipment.php');
            }
        ?>
    </div>

</div>
<?php require_once('../partials/crud-footer.php');?>

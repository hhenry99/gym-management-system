<?php
include('partials/header.php');

?>


<div class="main-content">
    <div class="header">
        <h1 class = "txt-center">Add Plan</h1>
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
            <table class="tbl-30">
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Duration</td>
                    <td>
                        <select name="duration">
                            <option value="1m">1 Mo</option>
                            <option value="3mo">3 Mo</option>
                            <option value="1y">1 Year</option>
                            <option value="em">Every Month</option>
                            <option value="ey">Every Year</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Cost</td>
                    <td><input type="number" name="cost" step = "0.01"></td>
                </tr>

                <tr>
                    <td colspan="2"><input type="submit" value="Add Plan" name = "submit"></td>
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

                $sql = "INSERT INTO plan SET
                        plan_name = '$name',
                        plan_description = '$description',
                        plan_duration = '$duration',
                        plan_cost = $cost;
                        ";

                $res = mysqli_query($conn,$sql);

                if($res == true)
                {
                    $_SESSION['add'] = "Admin successfully updated";
                    header('location:'.SITEURL.'manage-plan.php');
                }
                else 
                {
                    $_SESSION['add'] = "Fail to insert data";
                    header('location:'.SITEURL.'add-plan.php');
                }
            }
        ?>
    </div>
</div>


<?php
include('partials/footer.php');

?>


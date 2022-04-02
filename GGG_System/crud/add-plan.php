<?php
include('../partials/crud-header.php');
?>

<div class="main-content">
    <div class="header">
        <h1 class = "txt-center">Add Plan</h1>
    </div>

    <div class="info">
        <form action="" method = "POST">
            <table class="tbl-wrapper">
                <tr>
                    <td>Plan Name:</td>
                    <td><input type="text" name="name" placeholder = "Enter Plan Name" required></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" placeholder = "Enter Plan Description"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Duration (Month):</td>
                    <td>
                        <input type="number" name = "duration" min="0" placeholder = "Enter # of months" required>
                    </td>
                </tr>
                <tr>
                    <td>Cost:</td>
                    <td><input type="number" name="cost" step = "0.01" placeholder = "Enter Plan Cost" required></td>
                </tr>

                <tr>
                    <td colspan="2"><br><input type="submit" value="Add Plan" name = "submit" class="btn-primary"></td>
                </tr>

            </table>
        </form>

        <?php
            if(isset($_POST['submit'])){
                $name = $_POST['name'];
                $description = $_POST['description'];
                $duration = $_POST['duration'];
                $cost = $_POST['cost'];

                $sql = "INSERT INTO plan SET
                        name = '$name',
                        description = '$description',
                        duration = '$duration',
                        cost = $cost;
                        ";

                $res = mysqli_query($conn,$sql);

                $_SESSION['add'] = "<br><span class = 'txt-green'>Plan Added!</span>";
                header('location:'.SITEURL.'manage-plan.php');
            }
        ?>
    </div>
</div>

<?php
include('../partials/crud-footer.php');
?>


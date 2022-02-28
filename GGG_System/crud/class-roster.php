<?php include('../partials/crud-header.php');?>

<?php 
if(isset($_GET['id']))
{
    $class_id = $_GET['id'];
    $sql = "SELECT * FROM class where class_id = $class_id";
    $res = mysqli_query($conn,$sql);

    $count = mysqli_num_rows($res);

    if($count == 1)
    {
        $row = mysqli_fetch_assoc($res);
        $name = $row['name'];
        $trainer_id = $row['trainer_trainer_id'];
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
    $sql2 = "SELECT name from trainer where trainer_id = $trainer_id";
    $res2 = mysqli_query($conn, $sql2);

    $row = mysqli_fetch_assoc($res2);
    $trainer_name = $row['name'];

?>
<div class="main-content">
    <div class="header">
        <h1 class = "txt-center"><?php echo $name;?> Class</h1>
        <h2 class = "txt-center">Trainer: <?php echo $trainer_name;?></h2>
    </div>

    <div class="info">
        <a href="<?php echo SITEURL;?>crud/add-member-class.php?id=<?php echo $class_id;?>"><button class="btn-primary">Add Member</button></a>
        <a href="#"><button class="btn-primary">Clear Roster</button></a>
        <table class = "tbl-full txt-left">
            <tr>
                <th>Member Name</th>
                <th>Member Email</th>
                <th>Member Phone</th>
                <th>Actions</th>
            </tr>

            <tr>
                <td>Henry Nguyen</td>
                <td>Henry@gmail.com</td>
                <td>7321230</td>
                <td>
                    Update
                    Remove
                </td>
            </tr>
        </table>
    </div>
</div>

<?php include('../partials/crud-footer.php');?>



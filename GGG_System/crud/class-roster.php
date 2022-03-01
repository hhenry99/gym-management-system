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
        <p>
            <?php include('../partials/session_check.php');?>
        </p>
    </div>

    <div class="info">
        <a href="<?php echo SITEURL;?>crud/add-member-class.php?id=<?php echo $class_id;?>"><button class="btn-primary">Add Member</button></a>
        <a href="<?php echo SITEURL;?>crud/clear-roster.php?id=<?php echo $class_id;?>"><button class="btn-primary">Clear Roster</button></a>
        <table class = "tbl-full txt-left">
            <tr>
                <th>Member Name</th>
                <th>Member Email</th>
                <th>Member Phone</th>
                <th>Actions</th>
            </tr>

            <?php
                $sql3 = "SELECT member_id, name, email, phone
                        FROM member JOIN member_has_class
                            ON member_member_id = member_id
                        WHERE class_class_id = $class_id";
                $res3 = mysqli_query($conn, $sql3);
                $count = mysqli_num_rows($res3);

                if($count > 0){
                    while($row = mysqli_fetch_assoc($res3))
                    {
                        $member_id = $row['member_id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $phone = $row['phone'];
                        ?>
                        <tr>
                            <td><?php echo $name;?></td>
                            <td><?php echo $email;?></td>
                            <td><?php echo $phone;?></td>
                            <td>
                                <a href="<?php echo SITEURL;?>crud/delete-member-class.php?memberid=<?php echo $member_id;?>&classid=<?php echo $class_id;?>"><button class="btn-danger pad-1">Remove</button></a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                else
                {
                    ?>
                        <tr>
                            <td colspan = "4">No Data Found</td>
                        </tr>
                    <?php
                }
            ?>
        </table>
    </div>
</div>

<?php include('../partials/crud-footer.php');?>



<?php include('../partials/crud-header.php');?>

<?php 
if(isset($_GET['id']))
{
    $class_id = $_GET['id'];

    $sql = "SELECT name, user_user_id FROM class where class_id = $class_id";
    $res = mysqli_query($conn,$sql);

    if( mysqli_num_rows($res) == 1)
    {
        $row = mysqli_fetch_assoc($res);
        $name = $row['name'];
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
    if($trainer_id != ""){
        $sql2 = "SELECT name from user where user_id = $trainer_id";
        $res2 = mysqli_query($conn, $sql2);
    
        $row = mysqli_fetch_assoc($res2);
        $trainer_name = $row['name'];
    } else {
        $trainer_name = "None";
    }

?>


<div class="main-content">
    <div class="header txt-center">
        <h1><?php echo $name;?> Class</h1>
        <h2>Trainer: <?php echo $trainer_name;?></h2>
        <p>
            <?php include('../partials/session_check.php');?>
        </p>
    </div>

    <div class="info">
        <a href="<?php echo SITEURL;?>crud/add-member-class.php?id=<?php echo $class_id;?>"><button class="btn-primary">Add Member</button></a>
        <a href="<?php echo SITEURL;?>crud/clear-roster.php?id=<?php echo $class_id;?>"><button class="btn-primary">Clear Roster</button></a>
        <input type="text" id="search" autocomplete="off" placeholder = "SEARCH" style = "margin-left: 75px">

        <div id="searchresult">
        <table class = "content-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php 
                $sql3 = "SELECT user_id, name, email, phone
                        FROM user JOIN registration
                            ON user_user_id = user_id
                        WHERE class_class_id = $class_id AND class_status = 1";
                $res3 = mysqli_query($conn, $sql3);
                $count = mysqli_num_rows($res3);

                if($count > 0){
                    while($row = mysqli_fetch_assoc($res3))
                    {
                        $member_id = $row['user_id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $phone = $row['phone'];
                        ?>
                        <tr>
                            <td><?php echo $member_id;?></td>
                            <td><?php echo $name;?></td>
                            <td><?php echo $email;?></td>
                            <td><?php echo $phone;?></td>
                            <td>
                                <a href="<?php echo SITEURL;?>crud/delete-member-class.php?memberid=<?php echo $member_id;?>&classid=<?php echo $class_id;?>"><button class="btn-danger"><i class='fa-solid fa-x'></i></button></a>
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
            </tbody>
        </table>
        </div>

    </div>
</div>

<script type = "text/javascript">
    $(document).ready(function(){
        $("#search").keyup(function(){
            var input = $("#search").val();
            $.post("class-member-search.php", {
                input: input,
                id: <?php echo $class_id;?>
            }, function(data){
                $("#searchresult").html(data);
            });
        });
    });
</script>

<?php include('../partials/crud-footer.php');?>



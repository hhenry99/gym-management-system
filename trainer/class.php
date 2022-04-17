<?php 
include('partials/header.php');

if(isset($_GET['id'])){
    $classid = $_GET['id'];
    $sql = "SELECT class_id  FROM class where class_id = $classid";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) == 0){
        header('location:'.SITEURL.'trainer/index.php');
    }
} else {
    header('location:'.SITEURL.'trainer/index.php');
}
?>

<div class="main-content">
    <div class="header">
        <h1>Class</h1>
        <p>
            <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            ?>
        </p>
    </div>

    <div class="info">
        <a href="<?php echo SITEURL;?>trainer/add-member.php?id=<?php echo $classid;?>"><button class="btn-primary">Add Member</button></a>
        <a href="<?php echo SITEURL;?>trainer/clear-roster.php?id=<?php echo $classid;?>"><button class="btn-primary">Clear Roster</button></a>

        <table class = 'content-tbl'>
            <thead>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Actions</th>
            </thead>

            <tbody>
                <?php
                $sql = "SELECT user_id, name, phone, email FROM registration JOIN user ON user_user_id = user_id WHERE class_class_id = $classid AND class_status = 1";
                $res = mysqli_query($conn, $sql);
                if(mysqli_num_rows($res) > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        $user_id = $row['user_id'];
                        $name = $row['name'];
                        $phone = $row['phone'];
                        $email = $row['email'];
                        ?>
                        <tr>
                            <td><?php echo $name;?></td>
                            <td><?php echo $phone;?></td>
                            <td><?php echo $email;?></td>
                            <td>
                                <a href="<?php echo SITEURL;?>trainer/delete-member.php?memberid=<?php echo $member_id;?>&classid=<?php echo $class_id;?>"><button class="btn-danger"><i class='fa-solid fa-x'></i></button></a>
                            </td>   
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan ="4">No member enrolled</td>
                    </tr>
                    <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</div>

<?php require_once('partials/header.php');?>
<div class="main-content">
    <div class="header txt-center">
        <h1>Member</h1>
        <p>
            <?php
                include('partials/session_check.php');
            ?>
        </p>
    </div>

    <div class="info">
        <a href="<?php echo SITEURL?>crud/add-member.php"><button class="btn-primary">Add Member</button></a>
        <br>
        <br>
        <input type="text" id="search" autocomplete="off" placeholder = "SEARCH">

        <div id="searchresult">
        <table class="content-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <?php
                $sql = "SELECT * FROM user WHERE role = 1";
                $res = mysqli_query($conn, $sql);

                if(mysqli_num_rows($res) > 0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['user_id'];
                        $image = $row['image_name'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $phone = $row['phone'];
                        $status = $row['status'];
                        ?>
                            <tr>
                                <td><?php echo $id?>.</td>
                                <td>
                                    <?php 
                                        if($image != "")
                                        {
                                            ?>
                                            <img src="<?php echo SITEURL?>images/member/<?php echo $image?>" width = "75px" height = "75px">
                                            <?php
                                        }
                                        else
                                        {
                                            echo "<span class = 'txt-red'>No image available</span>";
                                        }
                                    ?>
                                </td>
                                <td><?php echo $name?></td>
                                <td><?php echo $email?></td>
                                <td><?php echo $phone?></td>
                                <td>
                                    <?php                 
                                    if($status == 1){
                                        $active = false;   
                                        $sql2 = "SELECT regist_id, class_status, plan_expired FROM registration WHERE user_user_id = $id HAVING class_status = 1 OR plan_expired >= NOW();";
                                        $res2 = mysqli_query($conn, $sql2);

                                        if(mysqli_num_rows($res2) > 0){
                                            $active = true;
                                        }
    
                                        if($active == true){
                                            echo "Active";
                                        } else {
                                            $sql3 = "UPDATE user SET status = 0 WHERE user_id = $id;";
                                            $res3 = mysqli_query($conn, $sql3);
                                            echo "Inactive";
                                        }
                                    } else {
                                        echo "Inactive";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="<?php echo SITEURL?>crud/update-member.php?id=<?php echo $id?>"><button class="btn-secondary"><i class="fa-solid fa-pen-to-square"></i></button></a> 
                                    <a href="<?php echo SITEURL?>crud/delete-member.php?id=<?php echo $id?>&image_name=<?php echo $image?>"><button class="btn-danger"><i class='fa-solid fa-x'></i></button></a>
                                </td>
                            </tr>
                        <?php
                    }
                }
                else
                {
                    ?>
                        <tr>
                            <td colspan = "6" class = "txt-center"><span class = 'txt-red'>No Members Found</span></td>
                        </tr>
                    <?php
                }
            ?>
        </table>
        </div>
    </div>
</div>

<script type = "text/javascript">
    $(document).ready(function(){
        $("#search").keyup(function(){
            var input = $("#search").val();
            $.post("crud/live-member-search.php", {
                input: input
            }, function(data){
                $("#searchresult").html(data);
            });
        });
    });
</script>

<?php require_once("partials/footer.php");?>
<?php include('partials/header.php');?>

<div class="main-content">
    <div class="header txt-center">
        <h1>Trainer</h1>
        <p>
            <?php include('partials/session_check.php');?>
        </p>
    </div>  

    <div class="info">
        <a href="crud/add-trainer.php"><button class="btn-primary">Add Trainer</button></a>
        <input type="text" id="search" autocomplete="off" placeholder = "SEARCH" style = "margin-left: 75px">

        <div id="searchresult">
        <table class = "content-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
 
            <tbody>
                <?php
                $sql = "SELECT * FROM user WHERE role = 2";
                $res = mysqli_query($conn, $sql);
                
                $count = mysqli_num_rows($res);
                if($count > 0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['user_id'];
                        $image = $row['image_name'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $phone = $row['phone'];

                        ?>
                        <tr>
                            <td><?php echo $id;?>.</td>
                            <td>
                                <?php 
                                if($image == "")
                                {
                                    echo "No Image Available";
                                }
                                else
                                {
                                    ?>
                                    <img src="images/trainer/<?php echo $image;?>" width = "50px" height = "50px">
                                    <?php
                                }
                                ?>
                            </td>
                            <td><?php echo $name;?></td>
                            <td><?php echo $email;?></td>
                            <td><?php echo $phone;?></td>
                            <td>
                                <a href="<?php echo SITEURL;?>crud/update-trainer.php?id=<?php echo $id;?>"><button class="btn-secondary pad-1"><i class="fa-solid fa-pen-to-square"></i></button></a>
                                <a href="<?php echo SITEURL;?>crud/delete-trainer.php?id=<?php echo $id;?>&image=<?php echo $image;?>"><button class="btn-danger pad-1"><i class='fa-solid fa-x'></i></button></a>
                            </td>
                        </tr>
                    <?php
                    }
                }
                else
                {
                    ?>
                    <tr>
                        <td colspan="5">No Trainer Available</td>
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
            $.post("crud/trainer-search.php", {
                input: input
            }, function(data){
                $("#searchresult").html(data);
            });
        });
    });
</script>

<?php include("partials/footer.php");?>
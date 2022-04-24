<?php include('partials/header.php');?>

<div class="main-content">
    <div class="header txt-center">
        <h1>Membership Plan</h1>
        <p>
            <?php  
                include('partials/session_check.php');
            ?>
        </p>
    </div>

    <div class="info">

        <a href="<?php echo SITEURL;?>crud/add-plan.php"><button class = "btn-primary">Add Plan</button></a>
        <input type="text" id="search" autocomplete="off" placeholder = "SEARCH" style = "margin-left: 75px">

        <div id="searchresult">
        <table class="content-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Duration</th>
                    <th>Cost</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php
                $sql = "SELECT * FROM plan;";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                if($count > 0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['plan_id'];
                        $name = $row['name'];
                        $des = $row['description'];
                        $duration = $row['duration'];
                        $cost = $row['cost'];
                        ?>
                        <tr>
                            <td><?php echo $id;?></td>
                            <td><?php echo $name;?></td>
                            <td><?php echo $des;?></td>
                            <td><?php echo $duration;?> Month</td>
                            <td>$<?php echo $cost;?></td>
                            <td>
                            <a href="<?php echo SITEURL;?>crud/update-plan.php?id=<?php echo $id;?>"><button class = "btn-secondary pad-1"><i class="fa-solid fa-pen-to-square"></i></button></a>
                            <a href="<?php echo SITEURL;?>crud/delete-plan.php?id=<?php echo $id;?>"><button class = "btn-danger pad-1"><i class='fa-solid fa-x'></i></button></a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <td colspan = '6'>No Plan Found</td>
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
            $.post("crud/plan-search.php", {
                input: input
            }, function(data){
                $("#searchresult").html(data);
            });
        });
    });
</script>

<?php include("partials/footer.php");?>
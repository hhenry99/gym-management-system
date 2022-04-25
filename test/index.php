<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Test</title>

</head>
<body>
    <?php 
    $sql = "SELECT  * FROM user";
    $res = mysqli_query($conn, $sql);
    $total = mysqli_num_rows($res);
    $page = ceil($total / 5);
    ?>
    <h1>Search</h1>
    <input type="text" id="search" autocomplete="off" placeholder = "SEARCH">
    <h1>SELECT</h1>
    <select name="select" id="num-select">
        <option value="1" selected>1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
    <h1>Result Goes Here:</h1>
    <div id="result">
        <?php
        $sql = "SELECT  * FROM user limit 5";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res)){
                echo '<br>'.$row['name'];
            }
        }

        ?>
    </div>
    <div id = "page#"></div>
    <br>
    <button id="back" onclick="prev()">Back</button>
    <button id="next" onclick="next()">Next</button>
    <!-- <input type="hidden" id="#page" value = > -->

    <script type = 'text/javascript'>
    $(document).ready(function(){
        $('#search').keyup(function(){
            var input = $("#search").val();
            $.post("search.php", {
                input: input
            }, function(data){
                $("#result").html(data);
            });
        });
    });

    var i = 0;
    function prev(){
        if(i == 0){
            document.getElementById('back').disabled = true;
        } else {
            i--;
            document.getElementById('next').disabled = false;
            return setPage();
        }
    }

    function next(){
        if(i == <?php echo $page;?>-1){
            document.getElementById('next').disabled = true;
        } else {
            i++;
            document.getElementById('back').disabled = false;
            return setPage();
        }
    }

    function setPage(){
        $.post('search.php', {page: i}, function(data){
            $('#result').html(data);
        })
    }

    </script>
</body>
</html>
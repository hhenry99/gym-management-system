<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <h3>Page Test</h3>
    <input type="text" id="search" autocomplete="off" placeholder = "SEARCH">
    <div id="data">

    </div>

    <script>
        $(document).ready(function(){
            load_data();
            function load_data(page)
            {
                $.ajax({
                    url: "pagination.php",
                    method: "POST",
                    data:{page: page},
                    success:function(data){
                        $('#data').html(data);
                    }
                })
            }

            $(document).on('click', '.pagination_link', function(){
                var page = $(this).attr("id");
                load_data(page, '*');
            });

            $("#search").keyup(function(){
                var input = $("#search").val();
                $.post("pagination.php", {
                    input: input
                }, function(data){
                    $("#result").html(data);
                });
            });
        });



    </script>
</body>
</html>
<?php include("partials/header.php");?>

        <div class="main-content">
            <div class="header">
                <h1>Dashboard</h1>
            </div>
<!--             
            <div class="info">
                Hi my name is henry
            </div> -->
            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
            <div class="box">
                <h3>Total Members:</h3>
                <p>500</p>
            </div>

            <div class="box">
                <h3>Total Members:</h3>
                <p>500</p>
            </div>

            <div class="box">
                <h3>Total Members:</h3>
                <p>500</p>
            </div>

            <div class="box">
                <h3>Total Members:</h3>
                <p>500</p>
            </div>
            
            <div class="box">
                <h3>Total Members:</h3>
                <p>500</p>
            </div>
            
            <div class="box">
                <h3>Total Members:</h3>
                <p>500</p>
            </div>
        </div>

        
<?php include("partials/footer.php");?>
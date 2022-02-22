<?php include("partials/header.php");?>

        <div class="main-content">
            <div class="header">
                <h1>Dashboard</h1>
                <p>
                    <?php
                        if(isset($_SESSION['login']))
                        {
                            echo $_SESSION['login'];
                            unset($_SESSION['login']);
                        }
                        if(isset($_SESSION['user']))
                        {
                            echo "Hello ".$_SESSION['user'];
                        }
                    ?>
                </p>

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
            
            <div class="box">
                <h3>Total Members:</h3>
                <p>500</p>
            </div>
        </div>

        
<?php include("partials/footer.php");?>
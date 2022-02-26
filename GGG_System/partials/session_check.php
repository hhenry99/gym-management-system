<?php
           
    //trainer
    if(isset($_SESSION['add-trainer']))
    {
        echo $_SESSION['add-trainer'];
        unset($_SESSION['add-trainer']);
    }
    if(isset($_SESSION['delete-trainer']))
    {
        echo $_SESSION['delete-trainer'];
        unset($_SESSION['delete-trainer']);
    }
    if(isset($_SESSION['update-trainer']))
    {
        echo $_SESSION['update-trainer'];
        unset($_SESSION['update-trainer']);
    }


?>
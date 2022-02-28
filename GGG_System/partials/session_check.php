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

    //class
    if(isset($_SESSION['add-class']))
    {
        echo $_SESSION['add-class'];
        unset($_SESSION['add-class']);
    }
    if(isset($_SESSION['delete-class']))
    {
        echo $_SESSION['delete-class'];
        unset($_SESSION['delete-class']);
    }
    if(isset($_SESSION['update-class']))
    {
        echo $_SESSION['update-class'];
        unset($_SESSION['update-class']);
    }
    if(isset($_SESSION['member-added']))
    {
        echo $_SESSION['member-added'];
        unset($_SESSION['member-added']);
    }

    // if(isset($_SESSION['member-not-found']))
    // {
    //     echo $_SESSION['member-not-found'];
    //     unset($_SESSION['member-not-found']);
    // }

?>
<?php
    //File to display all of the session messages
    
    // -----------------global---------------

    if(isset($_SESSION['upload']))
    {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }

    if(isset($_SESSION['username']))
    {
        echo $_SESSION['username'];
        unset($_SESSION['username']);
    }
    
    if(isset($_SESSION['add']))
    {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
    if(isset($_SESSION['delete']))
    {
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
    }
    if(isset($_SESSION['update']))
    {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }
    if(isset($_SESSION['remove']))
    {
        echo $_SESSION['remove'];
        unset($_SESSION['remove']);
    }

    //pay
    if(isset($_SESSION['add-pay']))
    {
        echo $_SESSION['add-pay'];
        unset($_SESSION['add-pay']);
    }   
    if(isset($_SESSION['delete-pay']))
    {
        echo $_SESSION['delete-pay'];
        unset($_SESSION['delete-pay']);
    }
?>
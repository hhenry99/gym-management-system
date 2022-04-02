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

    if(isset($_SESSION['delete_member_class']))
    {
        echo $_SESSION['delete_member_class'];
        unset($_SESSION['delete_member_class']);
    }

    if(isset($_SESSION['clear-roster']))
    {
        echo $_SESSION['clear-roster'];
        unset($_SESSION['clear-roster']);
    }

    //invoice
    if(isset($_SESSION['add-invoice']))
    {
        echo $_SESSION['add-invoice'];
        unset($_SESSION['add-invoice']);
    }
    if(isset($_SESSION['delete-invoice']))
    {
        echo $_SESSION['delete-invoice'];
        unset($_SESSION['delete-invoice']);
    }
    
    if(isset($_SESSION['update-invoice']))
    {
        echo $_SESSION['update-invoice'];
        unset($_SESSION['update-invoice']);
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
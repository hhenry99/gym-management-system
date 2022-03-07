<?php
           
    //global 
    if(isset($_SESSION['no-id-found']))
    {
        echo $_SESSION['no-id-found'];
        unset($_SESSION['no-id-found']);
    }

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

    if(isset($_SESSION['member-not-found']))
    {
        echo $_SESSION['member-not-found'];
        unset($_SESSION['member-not-found']);
    }

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
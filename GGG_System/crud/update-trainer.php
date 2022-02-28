<?php include('../partials/crud-header.php');?>

<?php

    if(isset($_GET['id']))  
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM trainer where trainer_id = $id";
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);
        if($count == 1)
        {
            $row = mysqli_fetch_assoc($res);
            $current_image = $row['image_name'];
            $name = $row['name'];
            $email =$row['email'];
            $phone = $row['phone'];
        }
        else
        {
            header('location:'.SITEURL.'manage-trainer.php');
        }
    }
    else
    {
        header('location:'.SITEURL.'manage-trainer.php');
    }

?>

<?php

    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        if(!empty($_FILES['image']['name']))
        {
            $image = $_FILES['image']['name'];
            $source = $_FILES['image']['tmp_name'];
            $destination = "../images/trainer/".$image;

            $upload = move_uploaded_file($source, $destination);

            if($upload == true)
            {
                if($current_image != "")
                {
                    $path = "../images/trainer/".$current_image;
                    $remove = unlink($path);
                }
            }
        }
        else
        {
            $image = $current_image;
        }

        $sql2 = "UPDATE trainer set 
                image_name = '$image',
                name = '$name',
                email = '$email',
                phone = '$phone'
                WHERE trainer_id = $id;
                ";

        $res2 = mysqli_query($conn,$sql2);

        if($res2 == true)
        {
            $_SESSION['update-trainer'] = "Trainer Updated Success!";
            header('location:'.SITEURL.'manage-trainer.php');
        }
    }

?>

<div class="main-content">
    <div class="header">
        <h1>Update Trainer</h1>
    </div>

    <div class="info">
        <form action="" method = "post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php
                            if($current_image == "")
                            {
                                echo "No Image Available";
                            }
                            else
                            {
                                ?>
                                    <img src="../images/trainer/<?php echo $current_image;?>" width = "100px">
                                <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select Image</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" value="<?php echo $name;?>" required></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email" value="<?php echo $email;?>" required></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><input type="text" name="phone" value="<?php echo $phone;?>" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="update" name = "submit" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('../partials/crud-footer.php');?>
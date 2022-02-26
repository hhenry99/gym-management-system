<?php include('../partials/crud-header.php');?>

<?php
if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if(!empty($_FILES['img']['name']))
    {
        $image = $_FILES['img']['name'];
        $source = $_FILES['img']['tmp_name'];
        $destination = "../images/trainer/".$image;
        
        $upload = move_uploaded_file($source, $destination);
    }
    else{
        $image = "";
    }

    $sql = "INSERT INTO trainer SET
            image_name = '$image',
            name = '$name',
            email = '$email',
            phone = '$phone';
            ";

    $res = mysqli_query($conn,$sql);

    if($res == true)
    {
        $_SESSION['add-trainer'] = "Trainer added";
        header('location:'.SITEURL.'manage-trainer.php');
    }
}
?>

<div class="main-content">
    <div class="header">
        <h1>Add Trainer</h1>
    </div>

    <div class="info">
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30 txt-left">
                <tr>
                    <td>Image</td>
                    <td><input type="file" name="img"></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>
                        <input type="text" name="name" >
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email" ></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><input type="phone" name="phone"></td>
                </tr>
                <tr>
                    <td colspan = "2">
                        <input type="submit" value="Submit" name="submit" class = "btn-primary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php include('../partials/crud-footer.php');?>
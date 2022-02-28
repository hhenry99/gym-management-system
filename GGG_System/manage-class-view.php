<?php include('partials/header.php');?>


<div class="main-content">
    <div class="header">
        <h1>Class</h1>
    </div>

    <div class="info">
        <a href="<?php echo SITEURL;?>crud/add-member-class.php"><button class="btn-primary">Add Member</button></a>
        <table class = "tbl-full txt-left">
            <tr>
                <th>Class Name</th>
                <th>Instructor Name</th>
                <th>Member Name</th>
                <th>Actions</th>
            </tr>

            <tr>
                <td>Yoga</td>
                <td>Henry Nguyen</td>
                <td>Johnny</td>
                <td>
                    Remove
                </td>
            </tr>
        </table>
    </div>
</div>

<?php include('partials/footer.php');?>



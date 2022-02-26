<?php include('partials/header.php');?>


<div class="main-content">
            <div class="header">
                <h1 class = "txt-center">Manage Class</h1>
                <p class = "txt-center">Success/Error will display here</p>
            </div>

            <div class="info">
                <div class="btn-container">
                    <a href="<?php echo SITEURL;?>crud/add-class.php"><button class = "btn-primary">Add Class</button></a>
                    <a href="<?php echo SITEURL;?>manage-class-view.php"><button class = "btn-primary">View Class</button></a>
                    <a href=""><button class="btn-primary">Add Member</button></a>
                </div>
                <table class = "tbl-full txt-left">
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Start/End</th>
                        <th>Cost</th>
                        <th>Trainer</th>
                        <th>Actions</th>
                    </tr>
                    <tr>
                        <td>Yoga</td>
                        <td>Learn to do yoga poses</td>
                        <td>Room101</td>
                        <td>Mon-Friday 8:00AM-12:00PM</td>
                        <td>$100</td>
                        <td>Henry</td>
                        <td>
                            <a href="#"><button class="btn-secondary pad-1">Update</button></a>
                            <a href="#"><button class="btn-danger pad-1">Delete</button></a>
                        </td>
                    </tr>

                </table>
                <!-- <p>test</p>
                <p>test</p> -->
                <table>
                    
                </table>
            </div>
        </div>

<?php include('partials/footer.php');?>
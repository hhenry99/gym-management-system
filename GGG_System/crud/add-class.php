<?php include('../partials/crud-header.php');?>


<div class="main-content">
    <div class="header">
        <h1>Add Class</h1>
    </div>

    <div class="info">
        <form action="" method = "POST">
            <table class="tbl-30">
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td>
                        <input type="text" name = "location">
                    </td>
                </tr>
                <tr>
                    <td>Start/End</td>
                    <td>
                        <textarea name="startend"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Cost</td>
                    <td><input type="number" name="cost" step = "0.01"></td>
                </tr>
                <tr>
                    <td>Trainer</td>
                    <td>Trainer</td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('../partials/crud-footer.php');?>
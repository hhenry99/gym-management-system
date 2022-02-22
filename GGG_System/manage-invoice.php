<?php include('partials/header.php'); ?>

<div class="main-content">
    <div class="header">
        <h1>Manage Invoice</h1>
        <p>Success/Error will display here</p>
    </div>

    <div class="info">
    <a href=""><button class="btn-primary">Create Invoice</button></a>
    <a href=""><button class="btn-primary">Pay History</button></a>

        <table class="tbl-full txt-left">
            <tr>
                <th>Invoice ID</th>
                <th>Member ID</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Date Created</th>
                <th>Due_Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            <tr>
                <td>1</td>
                <td>256</td>
                <td>Invoice for Basic Plan</td>
                <td>$100</td>
                <td>2/18/2022</td>
                <td>3/18/2022</td>
                <td>Not Paid</td>
                <td>
                    <a href=""><button class="btn-primary pad-1">Pay Now</button></a>
                    <a href=""><button class="btn-secondary pad-1">Update</button></a>
                    <a href=""><button class="btn-danger pad-1">Delete</button></a>
                    
                </td>
            </tr>
        </table>
        
    </div>
</div>

<?php include('partials/footer.php'); ?>




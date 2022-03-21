<?php include('../partials/crud-header.php');?>

<script>
    if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
    }
</script>

<div class="main-content">
    <div class="header">
        <h1>Manage Invoice</h1>
    </div>

    <div class="info">
        <?php
        if(isset($_POST['submit-search'])){
            $search = mysqli_real_escape_string($conn, $_POST['search']);
            $sql = "SELECT * FROM invoice where invoice_id LIKE '$search' OR member_member_id LIKE '$search';";
            $res = mysqli_query($conn, $sql);
            $count  = mysqli_num_rows($res);

            if($count > 0){
                echo $count." Invoice Found!";
                ?>
                <table class="tbl-full txt-left">
                    <tr>
                        <th>Invoice ID</th>
                        <th>Member ID</th>  
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Amount_Paid</th>
                        <th>Date Created</th>
                        <th>Due_Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                <?php
                while($row = mysqli_fetch_assoc($res)){
                    $invoice_id = $row['invoice_id'];
                    $name = $row['name'];
                    $amount = $row['amount'];
                    $date_created = $row['date_created'];
                    $duedate = $row['due_date'];
                    $member_id = $row['member_member_id'];
                    $amount_paid = $row['amount_paid'];
                ?>
                    <tr>
                        <td><?php echo $invoice_id;?></td>
                        <td><?php echo $member_id;?></td>
                        <td><?php echo $name;?></td>
                        <td><?php echo $amount;?></td>
                        <td><?php echo $amount_paid;?></td>
                        <td><?php echo $date_created;?></td>
                        <td><?php echo $duedate;?></td>
                        <td>
                            <?php 
                                if($amount_paid == '0.00')
                                {
                                    echo "Not Paid";
                                }
                                else if($amount_paid > 0)
                                {
                                    if($amount == $amount_paid){
                                        echo "Paid";
                                    }
                                    else{
                                        echo "Not Fully Paid";
                                    }
                                }
                            ?> 
                        </td>
                        <td> <!-- So what happens here is to display the "pay now" only if its not paid-->
                            <?php if($amount_paid != $amount){$siteurl = SITEURL; echo "<a href='{$siteurl}crud/pay-invoice.php?id={$invoice_id}'><button class='btn-primary pad-1'>Pay Now</button></a>"; }?>
                            <a href="<?php echo SITEURL;?>crud/update-invoice.php?id=<?php echo $invoice_id;?>"><button class="btn-secondary pad-1">Update</button></a>
                            <a href="<?php echo SITEURL;?>crud/delete-invoice.php?id=<?php echo $invoice_id;?>"><button class="btn-danger pad-1">Delete</button></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
                </table>
                <?php
            }else{
                echo "No Invoice Found :C <a href = ".SITEURL."manage-invoice.php>Go Back?</a>";
            }

        }
        else{
            header('location:'.SITEURL.'manage-invoice.php');
        }
        ?>
    </div>
</div>

<?php include('../partials/crud-footer.php');?>


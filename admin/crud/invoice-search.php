<?php 

include('../config/constant.php');

if(isset($_POST['input'])){
    $input = $_POST['input'];
    ?>
    <table class="content-table">
        <thead>
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
        </thead>

        <tbody>
        <?php
        $sql = "SELECT * FROM invoice WHERE invoice_id LIKE '$input%' OR user_user_id LIKE '$input%' OR name LIKE '$input%'";             
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if($count > 0)
        {
            while($row = mysqli_fetch_assoc($res)){
                $invoice_id = $row['invoice_id'];
                $name = $row['name'];
                $amount = $row['amount'];
                $date_created = $row['date_created'];
                $duedate = $row['due_date'];
                $member_id = $row['user_user_id'];
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
                        <a href="<?php echo SITEURL;?>crud/update-invoice.php?id=<?php echo $invoice_id;?>"><button class="btn-secondary pad-1"><i class="fa-solid fa-pen-to-square"></i></button></a>
                        <a href="<?php echo SITEURL;?>crud/delete-invoice.php?id=<?php echo $invoice_id;?>"><button class="btn-danger pad-1"><i class='fa-solid fa-x'></i></button></a>
                    </td>
                </tr>
                <?php
            }
        }
        else
        {
            ?>
            <tr>
                <td colspan="8">No Invoice Found</td>
            </tr>
            <?php
        }
        ?>
        </tbody>

    </table>
    <?php
}
include('../config/close-connection.php');
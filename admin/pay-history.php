<?php include('partials/header.php');?>


<div class="main-content">
    <div class="header txt-center">
        <h1>Pay History</h1>
        <p><?php include('partials/session_check.php');?></p>
    </div>

    <div class="info">
        <!-- <div class="search">
            <form action="" method="get">
                <input type="text" name="search">
            </form>
        </div> -->

        <table class="content-table">
            <thead>
                <tr>
                    <th>Pay No.</th>
                    <th>Invoice ID</th>
                    <th>Card_Number</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    $sql = "SELECT payment_id, right(card_number,4), payment_amount, payment_date, invoice_invoice_id FROM payment";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    if($count > 0)
                    {
                        while($row = mysqli_fetch_assoc($res)){
                            $pay_id = $row['payment_id'];
                            $card_no = $row['right(card_number,4)'];
                            $amount = $row['payment_amount'];
                            $date = $row['payment_date'];
                            $invoice_id = $row['invoice_invoice_id'];
                            ?>
                            <tr>
                                <td><?php echo $pay_id;?></td>
                                <td><?php echo $invoice_id;?></td>
                                <td>xxxx-<?php echo $card_no;?></td>
                                <td><?php echo $amount;?></td>
                                <td><?php echo $date;?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>crud/delete-pay.php?payid=<?php echo $pay_id;?>"><button class="btn-danger pad-1"><i class='fa-solid fa-x'></i></button></a>
                                    
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <tr>
                            <td colspan="6">No Data Found...</td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('partials/footer.php');?>
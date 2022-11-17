<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Invoices</title>
    <link href="<?php echo CSS_PATH ?>styles.css" rel="stylesheet" media="all">
</head>

<body>
    <?php include("nav.php"); ?>
    <div class="form-list-view-keeper"> 
    
        <table class = keeper-list>
            <h1>Invoices List</h1>
            <thead>
                <th>Invoice Number</th>    
                <th>Booking Nr</th>
                <th>Start Date</th>
                <th>End Date</th>      
                <th>Invoice Date</th>
            </thead>
            <tbody>
                <?php
                foreach ($invoiceList as $invoice) {
                ?>
                    <tr>
                        <td><?php echo $invoice->getInvoiceNr() ?></td>
                        <td><?php echo $invoice->getBooking()->getBookingNumber() ?></td>
                        <td><?php echo $invoice->getBooking()->getStartDate() ?></td>
                        <td><?php echo $invoice->getBooking()->getEndDate() ?></td>
                        <td><?php echo $invoice->getInvoiceDate() ?></td>
                    
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <a class="" href="<?php echo FRONT_ROOT ?>Keeper/KeeperLogin">Go back to Dashsboard</a> 
    </div>
</body>

</html>
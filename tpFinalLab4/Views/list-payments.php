<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Payments</title>
    <link href="<?php echo CSS_PATH ?>styles.css" rel="stylesheet" media="all">
    <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>
    <?php include("nav.php"); ?>
    <div class="form-list-view-pet">
    <!--<form action="<?php echo FRONT_ROOT ?>Payment/ShowAddView" method="post">-->
            <h1>Payments List</h1>
            <table class="list-pet">
                <thead>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Inovoice Nr</th>
                    <th>Image</th>                    
                </thead>
                <tbody>
                    <?php
                        foreach ($paymentList as $payment) {
                        ?>
                            <tr>
                                <td><?php echo $payment->getPaymentDate() ?></td>
                                <td><?php echo $payment->getAmount() ?></td>
                                <td><?php echo $payment->getInvoice()->getInvoiceNr() ?></td>
                                <td>
                                    <?php
                                        if(null!== $payment->getPaymentImage())
                                        {
                                            ?>
                                                <img src="<?php echo FRONT_ROOT.UPLOADS_PATH.$payment->getPaymentImage() ?>" width="auto" height="100">
                                            <?php
                                        }
                                    ?>
                                </td>                                          
                            </tr>
                        <?php
                            }
                    ?>
                    <!--<div class="btn-list-pet">
                    <td><button type="submit" name="bookingNr" class="" value="<?php echo $bookingNr?>">Add another payment</button> </td> 
                    </div> -->
                </tbody>
            </table>
            </form>
            
            <a class="btn-list-pet" href="<?php echo FRONT_ROOT ?>Owner/OwnerLogin">Go back to Dashboard</a>
        </div>
    
    
    
    
</body>

</html>
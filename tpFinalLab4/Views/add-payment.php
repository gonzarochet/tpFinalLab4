<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Payment</title>
    <link href="<?php echo CSS_PATH?>styles.css" rel="stylesheet" media="all">
    <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
    
</head>

<body>
    <?php include("nav.php"); ?>
    <section id="add-pet-principal">
        <div class="form-add-pet">
            <form action="<?php echo FRONT_ROOT ?>Payment/Add" method="post" enctype="multipart/form-data">
                <h1>Add Payment</h1>
                <div class="form-content-add-pet">
                    <label for="">Select Invoice</label>
                    <select name="invoiceid">
                        <?php foreach($listInvoices as $invoice)
                            {
                        ?>
                            <option value="<?php echo $invoice->getInvoiceId()?>"><?php echo "Invoice Nr: ".$invoice->getInvoiceNr().", Total: ". $invoice->getValue()?></option>
                        <?php 
                            }
                        ?>
                    </select>
                </div>
               
                <div class="form-content-add-pet">
                    <label for="">Payment Date</label>
                    <input type="date" name="paymentDate" required>
                </div>
                
                <div class="form-content-add-pet">
                    <label for="">Paid Amount</label>
                    <input type="text" name="amount" required>
                </div>
                <div class="form-content-add-pet">
                    <label for="">Payment Image</label>
                    <input type="file" name="file"  required>
                </div>
                <div class="form-content-add-pet-btn">
                    <input type="submit" class="btn" value="Agregar" />
                </div>
            </form>
            <a class="btn-goback" href="<?php echo FRONT_ROOT ?>Owner/OwnerLogin">Go back to Dashboard</a>
        </div>
    </section>

</body>

</html>
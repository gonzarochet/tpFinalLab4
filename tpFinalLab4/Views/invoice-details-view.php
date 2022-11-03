<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice details</title>
    <link href="<?php echo CSS_PATH ?>styles.css" rel="stylesheet" media="all">
    <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>
    <?php include("nav.php"); ?>
    <div class="form-list-view-keeper">
        <form action="<?php echo FRONT_ROOT ?>Invoice/Add" method="post">
            <h1>Invoice details</h1>
            <table class="keeper-list">
                <thead>
                    <th>Booking Nr</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Keeper</th>
                    <th>Pet</th>
                    <th>Required Deposit</th>
                    <th>Total Price</th>
                    <th></th>
                </thead>
                <tbody>
                        <tr>
                            <td><?php echo $bookingNr ?></td>
                            <td><?php echo $booking->getStartDate() ?></td>
                            <td><?php echo $booking->getEndDate() ?></td>
                            <td><?php echo $booking->getKeeper()->getUser()->getFirstName() ?></td>
                            <td><?php echo $booking->getPet()->getName()?></td>
                            <td><?php echo $booking->getTotalPrice() /2?></td>
                            <td><?php echo $booking->getTotalPrice()?></td>
                            <td><button type="submit" name="bookingNr" class="btn-table" value="<?php echo $bookingNr?>">Create Invoice</button> </td>
                        </tr>
                </tbody>
        </form>
    </div>
    </table>
    <a class="btn-list-pet" href="<?php echo FRONT_ROOT ?>Keeper/KeeperLogin">Cancel</a>
</body>

</html>
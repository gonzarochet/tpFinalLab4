<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Bookings</title>
    <link href="<?php echo CSS_PATH ?>styles.css" rel="stylesheet" media="all">
</head>

<body>
    <?php include("nav.php"); ?>
    <div class="form-list-view-keeper"> 
        <table class = keeper-list>
            <h1>Bookings List</h1>
            <thead>
                <th>Booking Nr</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Keeper</th>
                <th>Owner</th>
                
            </thead>
            <tbody>
                <?php
                foreach ($bookingList as $booking) {
                ?>
                    <tr>
                        <td><?php echo $booking->getBookingNumber() ?></td>
                        <td><?php echo $booking->getStartDate() ?></td>
                        <td><?php echo $booking->getEndDate() ?></td>
                        <td><?php echo $booking->getKeeper()->getKeeperId() ?></td>
                        <td><?php echo $booking->getOwner()->getOwnerId() ?></td>
                        
                    </tr>
                <?php
                }
                ?>
                </tr>
            </tbody>
        </table>
        <a class="" href="<?php echo FRONT_ROOT ?>Owner/OwnerLogin">Go back to Dashsboard</a>
    </div>
</body>

</html>
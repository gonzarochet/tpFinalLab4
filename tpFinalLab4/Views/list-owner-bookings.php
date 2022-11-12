<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Bookings</title>
    <link href="<?php echo CSS_PATH ?>styles.css" rel="stylesheet" media="all">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>
    <?php include("nav.php"); 
    use Models\Booking;
    ?>

    <div class="form-list-view-keeper">
        <form action="<?php echo FRONT_ROOT ?>Invoice/Add" method="post">
            <table class=keeper-list>
                <h1>Bookings List</h1>
                <thead>
                    <th>Booking Nr</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Keeper</th>
                    <th>Pet</th>
                    <th>Accepted</th>
                    <th>Add Payment</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($bookingList as $booking) {
                        if($booking->getEndDate()>date("Y-m-d")){
                    ?>
                        <tr>
                            <td><?php echo $booking->getBookingNumber() ?></td>
                            <td><?php echo $booking->getStartDate() ?></td>
                            <td><?php echo $booking->getEndDate() ?></td>
                            <td><?php echo $booking->getKeeper()->getUser()->getFirstName() . " " . $booking->getKeeper()->getUser()->getLastName() ?></td>
                            <td><?php echo $booking->getPet()->getName() ?></td>
                            <td><?php echo $booking->getIsAccepted() ?></td>
                            <td><button type="submit" name="bookingNr" class="btn-table" value="<?php echo $booking->getBookingNumber() ?>">Add Invoice</button> </td>
                        </tr>
                    <?php
                    }
                }
                    ?>
                    </tr>
                </tbody>
            </table>
            <a class="cancel-register-register" href="<?php echo FRONT_ROOT?>Owner/OwnerLogin">Go to the Dashsboard</a>
        </form>

    </div>



    <div class="form-list-view-keeper">
        <form action="<?php echo FRONT_ROOT ?>Review/showReviewAddView" method="post">
            <table class=keeper-list>
                <h1>Bookings Historic List</h1>
                <thead>
                    <th>Booking Nr</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Keeper</th>
                    <th>Pet</th>
                    <th>Accepted</th>
                    <?php // si el review existe -> View, si no existe -> Add 
                    ?>
                    <th>Add Review</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($bookingList as $booking) {
                        if ($booking->getEndDate() <= date('Y-m-d')) {
                    ?>
                            <tr>
                                <td><?php echo $booking->getBookingNumber() ?></td>
                                <td><?php echo $booking->getStartDate() ?></td>
                                <td><?php echo $booking->getEndDate() ?></td>
                                <td><?php echo $booking->getKeeper()->getUser()->getFirstName() . " " . $booking->getKeeper()->getUser()->getLastName() ?></td>
                                <td><?php echo $booking->getPet()->getName() ?></td>
                                <td><?php echo $booking->getIsAccepted() ?></td>
                                <td><button type="submit" name="bookingNr" class="btn-table" value="<?php echo $booking->getBookingNumber(); ?>">Review</button> </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                    </tr>
                </tbody>
            </table>
            <a class="cancel-register-register" href="<?php echo FRONT_ROOT?>Owner/OwnerLogin">Go to the Dashsboard</a>
        </form>
    </div>

   

</body>

</html>
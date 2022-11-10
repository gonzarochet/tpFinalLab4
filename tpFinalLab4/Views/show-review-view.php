<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Reviews</title>
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
        <form action="<?php echo FRONT_ROOT?>" method="post">
            <table class=keeper-list>
                <h1>Review List</h1>
                <thead>
                    <th>Booking Nr</th>
                    <th>Pet</th>
                    <th>Keeper</th>
                    <th>Score</th>
                    <th>Comments</th>
                </thead>
                <tbody>
                    <?php
                    foreach (@$reviewList as $review) {
                    ?>
                        <tr>
                            <td><?php echo $review->getAsociatedBooking()->getBookingNumber()?></td>
                            <td><?php echo $review->getAsociatedBooking()->getPet()->getName(); ?></td>
                            <td><?php echo $review->getAsociatedBooking()->getKeeper()->getUser()->getFirstName(); ?></td>
                            <td><?php echo $review->getScore()?></td>
                            <td><?php echo $review->getComment()?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tr>
                </tbody>
            </table>
            <a class="cancel-register-register" href="<?php echo FRONT_ROOT?>Owner/OwnerLogin">Go to the Dashsboard</a>
        </form>
    </div>
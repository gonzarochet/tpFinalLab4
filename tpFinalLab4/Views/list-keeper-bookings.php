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
        <form action="<?php echo FRONT_ROOT ?>Booking/Confirmation" method="post">
            <table class=keeper-list>
                <h1>Bookings List</h1>
                <thead>
                    <th>Booking Nr</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Owner</th>
                    <th>Pet Name</th>
                    <th>Pet Size</th>
                    <th>Pet Picture</th>
                    <th>Pet Vaccination Plan</th>
                    <th>Pet Video</th>
                    <th>Comments</th>
                    <th>Is Confirmed</th>
                    <th>Confirm</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($bookingList as $booking) {
                    ?>
                        <tr>
                            <td><?php echo $booking->getBookingNumber() ?></td>
                            <td><?php echo $booking->getStartDate() ?></td>
                            <td><?php echo $booking->getEndDate() ?></td>
                            <td><?php echo $booking->getPet()->getOwner()->getUser()->getFirstName() . " " . $booking->getPet()->getOwner()->getUser()->getLastName() ?></td>
                            <td><?php echo $booking->getPet()->getName() ?></td>
                            <td><?php echo $booking->getPet()->getSize() ?></td>


                            <td><?php $image = $booking->getPet()->getPicture();
                                if (!filter_var($image, FILTER_VALIDATE_URL) === false) {
                                    $imageData = base64_encode(file_get_contents($image));
                                    echo '<img src="data:image/jpeg;base64,' . $imageData . '" width="auto" height="100">';
                                }
                                ?></td>
                            <td><?php $image = $booking->getPet()->getVaccinationPlan();
                                if (!filter_var($image, FILTER_VALIDATE_URL) === false) //valdiates if url is valid
                                {
                                    $imageData = base64_encode(file_get_contents($image));
                                    echo '<img src="data:image/jpeg;base64,' . $imageData . '" width="auto" height="100">';
                                }
                                ?></td>
                            <td>
                                <iframe width="150" height="100" src="<?php if (!filter_var($booking->getPet()->getVideo(), FILTER_VALIDATE_URL) === false) {
                                                                            echo $booking->getPet()->getVideo();
                                                                        } ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                </iframe>
                            </td>
                            <td><?php echo $booking->getPet()->getComments() ?></td>
                            <td><?php echo $booking->getIsConfirmed() ?></td>
                            <td><?php if ($booking->getIsConfirmed() == 'No') {
                                ?>
                                    <button type="submit" name="bookingNr" class="btn-table" value="<?php echo $booking->getBookingNumber() ?>"> Confirm </button>
                            </td>

                        <?php
                                }
                        ?>
                        </tr>

                    <?php
                    }
                    ?>
                    </tr>
                </tbody>
            </table>
        </form>

        <a class="" href="<?php echo FRONT_ROOT ?>Keeper/KeeperLogin">Go back to Dashsboard</a>

    </div>
</body>

</html>
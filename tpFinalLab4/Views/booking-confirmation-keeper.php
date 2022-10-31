<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link href="<?php echo CSS_PATH ?>styles.css" rel="stylesheet" media="all">
</head>

<body>
    <?php include("nav.php"); ?>
    <div class="form-list-view-keeper">
        <form action="<?php echo FRONT_ROOT ?>Booking/Confirmation" method="post">
            <h1>Booking Confirmation Keeper</h1>
            <table class="keeper-list">
                <thead>
                    <th>Booking Number</th>
                    <th>Booking Date</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Fee</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Breed</th>
                    <th>Size</th>
                    <th>Picture</th>
                    <th>Vaccination Plan</th>
                    <th>Video </th>
                    <th>Comments </th>                    
                </thead>
                <tbody>
                        <tr>
                            <td><?php echo $booking->getBookingNumber() ?></td>
                            <td><?php echo $booking->getBookingDate() ?></td>
                            <td><?php echo $booking->getStartDate() ?></td>
                            <td><?php echo $booking->getEndDate() ?></td>
                            <td><?php echo $booking->getFee() ?></td>
                            <td><?php echo $booking->getPet()->getName() ?></td>
                            <td><?php echo $booking->getPet()->getAge() ?></td>
                            <td><?php echo $booking->getPet()->getBreed() ?></td>
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
                                <iframe width="150" height="130" src="<?php if (!filter_var($booking->getPet()->getVideo(), FILTER_VALIDATE_URL) === false) {
                                                                            echo $booking->getPet()->getVideo();
                                                                        } ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                </iframe>
                            </td>
                            <td><?php echo $booking->getPet()->getComments() ?></td>
                            <td><button type="submit" name="bookingNr" class="btn-table" value="<?php echo $booking->getBookingNumber()?>">Accept </button> </td>
                        </tr>
                </tbody>
        </form>
    </div>
    </table>
    <a class="btn-list-pet" href="<?php echo FRONT_ROOT ?>Owner/OwnerLogin">Go back to Dashsboard</a>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Keeper</title>
    <link href="<?php echo CSS_PATH ?>styles.css" rel="stylesheet" media="all">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>
    <?php include("nav.php"); ?>
    <div class="form-list-view-keeper">
        <h3><?php echo $message ?></h3>
        <?php if ($flag) { ?>
            <form action="<?php echo FRONT_ROOT?>Booking/ShowOwnerConfirmationView" method="post">
                <table class=keeper-list>
                    <h1>Available Keepers</h1>
                    <thead>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Reputation</th>
                        <th>Book</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($keeperList as $keeper) {
                        ?>
                            <tr>
                                <td><?php echo $keeper->getUser()->getUsername() ?></td>
                                <td><?php echo $keeper->getUser()->getEmail() ?></td>
                                <td><?php echo $keeper->getUser()->getFirstName() . " " . $keeper->getUser()->getLastName() ?></td>
                                <td><?php echo $keeper->getUser()->getAge() ?></td>
                                <td><?php echo round($keeper->getReputation(),2) ?></td>
                                <input type="hidden" name="startDate" value="<?php echo $startDate ?>" />
                                <input type="hidden" name="endDate" value="<?php echo $endDate ?>" />
                                <input type="hidden" name="petid" value="<?php echo $petid ?>" />

                                <td><button type="submit" name="keeperid" class="" value="<?php echo $keeper->getKeeperId()
                                                                                            ?>">Book</button> </td>

                            </tr>
                        <?php
                        }
                        ?>
                        </tr>
                    </tbody>
                </table>
                <a class="" href="<?php echo FRONT_ROOT ?>Owner/OwnerLogin">Go back to Dashsboard</a>
            </form>
        <?php } else { ?>
            <a class="btn-list-pet" href="<?php echo FRONT_ROOT ?>Calendar/ShowAvailableKeepersSearchView">Cancel</a>
        <?php } ?>

    </div>
</body>

</html>
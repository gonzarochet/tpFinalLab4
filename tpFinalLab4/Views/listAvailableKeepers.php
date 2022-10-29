<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Keeper</title>
    <link href="<?php echo CSS_PATH ?>styles.css" rel="stylesheet" media="all">
</head>

<body>
    <?php include("nav.php"); ?>
    <div class="form-list-view-keeper">
    <form action="<?php echo FRONT_ROOT ?>Booking/ShowConfirmationView" method="post">
        <table class = keeper-list>
            <h1>Available Keepers</h1>
            <thead>
                <th>Username</th>
                <th>Email</th>
                <th>LastName</th>
                <th>FirstName</th>
                <th>Age</th>
                <th>Reputation</th>
                <th>DateFrom
                <th>Book</th>
            </thead>
            <tbody>
                <?php
                foreach ($keeperList as $keeper) {
                ?>
                    <tr>
                        <td><?php echo $keeper->getUser()->getUsername() ?></td>
                        <td><?php echo $keeper->getUser()->getEmail() ?></td>
                        <td><?php echo $keeper->getUser()->getLastName() ?></td>
                        <td><?php echo $keeper->getUser()->getFirstName() ?></td>
                        <td><?php echo $keeper->getUser()->getAge() ?></td>
                        <td><?php echo $keeper->getReputation() ?></td>
                        <input type="hidden" name="startDate" value="<?php echo $startDate?>"/>
                        <input type="hidden" name="endDate" value="<?php echo $endDate?>"/>
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
    </div>
</body>

</html>
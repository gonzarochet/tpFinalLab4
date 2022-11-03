<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Pets</title>
    <link href="<?php echo CSS_PATH ?>styles.css" rel="stylesheet" media="all">
    <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>
    <?php include("nav.php"); ?>
    <div class="form-list-view-calendar">
        <form action="<?php echo FRONT_ROOT ?>Calendar/SetUnavailable" method="post">
            <h1>Calendar Dates List</h1>
            <table class="calendar-list">
                <thead>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Set Unavailable</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($calendarList as $calendar) {
                    ?>
                        <tr>
                            <td><?php echo $calendar->getDate() ?></td>
                            <td><?php echo $calendar->getStatus() ?></td>
                            <td><?php if ($calendar->getStatus()=='Available')
                                {
                                    ?>
                                <button type="submit" name="id" class="btn-set-unavaliable-calendar" value="<?php echo $calendar->getCalendarId() 
                                                                                    ?>">Set Unavailable</button> 
                                <?php } ?>                                                   
                            </td>

                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
        </form>
        </table>
        <a class="cancel-register" href="<?php echo FRONT_ROOT ?>Keeper/KeeperLogin">Go back to Dashsboard</a>
    </div>
</body>

</html>
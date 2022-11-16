<?php namespace Views;
require_once('nav.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
    <title>List of Owner</title>
</head>
<body>
<table>
    <thead>
        <th>Username</th>
        <th>Fullname</th>
        <th>Age</th>
        <th>Date of Register</th>
    </thead>
    <tbody>
        <?php
            foreach($ownerList as $owner)
            {
                ?>
                    <tr>
                        <td><?php echo $owner->getUser()->getUsername() ?></td>
                        <td><?php echo $owner->getUser()->getLastName(). " ".$owner->getFirstName()?></td>
                        <td><?php echo $owner->getUser()->getDateBirth() ?></td>
                    </tr>
                <?php
            }
        ?>
        </tr>
    </tbody>
</table>
</body>
</html>
<?php namespace Views;
require_once('nav.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Owner</title>
</head>
<body>
<table>
    <thead>
        <th>IdOwner</th>
        <th>IdUser</th>
        <th>Username</th>
        <th>Email</th>
        <th>Password</th>
        <th>LastName</th>
        <th>FirstName</th>
        <th>Date of Birth</th>
    </thead>
    <tbody>
        <?php
            foreach($ownerList as $owner)
            {
                ?>
                    <tr>
                        <td><?php echo $owner->getOwnerId()?></td>
                        <td><?php echo $owner->getUser()->getId() ?></td>
                        <td><?php echo $owner->getUser()->getUsername() ?></td>
                        <td><?php echo $owner->getUser()->getEmail() ?></td>
                        <td><?php echo $owner->getUser()->getPassword() ?></td>
                        <td><?php echo $owner->getUser()->getLastName() ?></td>
                        <td><?php echo $owner->getUser()->getFirstName() ?></td>
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
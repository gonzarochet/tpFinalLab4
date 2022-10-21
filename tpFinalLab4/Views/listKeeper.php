<?php namespace Views;
require_once('nav.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Keeper</title>
</head>
<body>
<table>
    <thead>
        <th>idKeeper</th>
        <th>IdUser</th>
        <th>Username</th>
        <th>Email</th>
        <th>Password</th>
        <th>LastName</th>
        <th>FirstName</th>
        <th>Date of Birth</th>
        <th>Reputation</th>
    </thead>
    <tbody>
        <?php
            foreach($keeperList as $keeper)
            {
                ?>
                    <tr>
                        <td><?php echo $keeper->getKeeperId()?></td>
                        <td><?php echo $keeper->getUser()->getId() ?></td>
                        <td><?php echo $keeper->getUser()->getUsername() ?></td>
                        <td><?php echo $keeper->getUser()->getEmail() ?></td>
                        <td><?php echo $keeper->getUser()->getPassword() ?></td>
                        <td><?php echo $keeper->getUser()->getLastName() ?></td>
                        <td><?php echo $keeper->getUser()->getFirstName() ?></td>
                        <td><?php echo $keeper->getUser()->getDateBirth() ?></td>
                        <td><?php echo $keeper->getReputation()?></td>
                    </tr>
                <?php
            }
        ?>
        </tr>
    </tbody>
</table>
</body>
</html>
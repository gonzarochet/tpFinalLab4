<?php namespace Views;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Owners</title>
</head>
<body>
<table>
    <thead>
        <th>Id</th>
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
                        <td><?php echo $owner->getId() ?></td>
                        <td><?php echo $owner->getUsername() ?></td>
                        <td><?php echo $owner->getEmail() ?></td>
                        <td><?php echo $owner->getPassword() ?></td>
                        <td><?php echo $owner->getLastName() ?></td>
                        <td><?php echo $owner->getFirstName() ?></td>
                        <td><?php echo $owner->getDateBirth() ?></td>
                    </tr>
                <?php
            }
        ?>
        </tr>
    </tbody>
</table>
</body>
</html>
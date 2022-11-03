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
    <title>List of User</title>
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
            foreach($userList as $user)
            {
                ?>
                    <tr>
                        <td><?php echo $user->getId() ?></td>
                        <td><?php echo $user->getUsername() ?></td>
                        <td><?php echo $user->getEmail() ?></td>
                        <td><?php echo $user->getPassword() ?></td>
                        <td><?php echo $user->getLastName() ?></td>
                        <td><?php echo $user->getFirstName() ?></td>
                        <td><?php echo $user->getDateBirth() ?></td>
                    </tr>
                <?php
            }
        ?>
        </tr>
    </tbody>
</table>
</body>
</html>
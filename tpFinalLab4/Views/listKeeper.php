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
        <table class = keeper-list>
            <h1>Keepers List</h1>
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
                foreach ($keeperList as $keeper) {
                ?>
                    <tr>
                        <td><?php echo $keeper->getKeeperId() ?></td>
                        <td><?php echo $keeper->getUser()->getId() ?></td>
                        <td><?php echo $keeper->getUser()->getUsername() ?></td>
                        <td><?php echo $keeper->getUser()->getEmail() ?></td>
                        <td><?php echo $keeper->getUser()->getPassword() ?></td>
                        <td><?php echo $keeper->getUser()->getLastName() ?></td>
                        <td><?php echo $keeper->getUser()->getFirstName() ?></td>
                        <td><?php echo $keeper->getUser()->getDateBirth() ?></td>
                        <td><?php echo $keeper->getReputation() ?></td>
                    </tr>
                <?php
                }
                ?>
                </tr>
            </tbody>
        </table>
        <a class="" href="<?php echo FRONT_ROOT ?>Owner/OwnerLogin">Go back to Dashsboard</a>
    </div>
</body>

</html>
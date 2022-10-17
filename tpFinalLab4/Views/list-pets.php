<?php namespace Views;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Pets</title>
</head>
<body>
<table>
    <thead>
        <th>IdPet</th>
        <th>Name</th>
        <th>Owner</th>
        <th>Vaccination Plan</th>
        <th>Birth Date</th>
        <th>Picture</th>
        <th>Breed</th>
    </thead>
    <tbody>
        <?php
            foreach($petList as $pet)
            {
                ?>
                    <tr>
                        <td><?php echo $pet->getIdPet() ?></td>
                        <td><?php echo $pet->getName() ?></td>
                        <td><?php echo ''?></td>
                        <td><?php echo $pet->getVaccinationPlan() ?></td>
                        <td><?php echo $pet->getBirthDate() ?></td>
                        <td><?php echo $pet->getPicture() ?></td>
                        <td><?php echo $pet->getBreed() ?></td>
                    </tr>
                <?php
            }
        ?>
        </tr>
    </tbody>
</table>
</body>
</html>
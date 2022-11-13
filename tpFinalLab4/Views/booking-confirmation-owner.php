<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Preview</title>
    <link href="<?php echo CSS_PATH ?>styles.css" rel="stylesheet" media="all">
    <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>
    <?php include("nav.php"); ?>
    <div class="form-list-view-keeper">
        <form action="<?php echo FRONT_ROOT ?>Booking/Add" method="post">
            <h1>Booking Preview</h1>
            <table class="keeper-list">
                <thead>
                    <th>Start Date</th>
                    <th>End Date</th>                    
                    <th>Keeper Name</th>
                    <th>Pet</th>
                    
                </thead>
                <tbody>
                        <tr>
                            <td><?php echo $startDate ?></td>
                            <td><?php echo $endDate ?></td>
                            <td><?php echo $keeper->getUser()->getFirstName()." ".$keeper->getUser()->getLastName() ?></td>
                            <td><?php echo $pet->getName()?><td>
                            <td>
                            <input type="hidden" name="petid" value="<?php echo $pet->getIdPet()?>"/>
                            <input type="hidden" name="startDate" value="<?php echo $startDate?>"/>
                            <input type="hidden" name="endDate" value="<?php echo $endDate?>"/>
                            <input type="hidden" name="keeperid" value="<?php echo $keeperid?>"/>
                            
                            
                           
                            <td><button type="submit" name="" class="btn-table" value=""> Confirm </button> </td>
                        </tr>
                </tbody>
        </form>
    </div>
    </table>
    <a class="btn-list-pet" href="<?php echo FRONT_ROOT ?>Owner/OwnerLogin">Go back to Dashsboard</a>
</body>

</html>
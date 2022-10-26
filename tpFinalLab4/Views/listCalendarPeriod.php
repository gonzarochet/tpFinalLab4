<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Pets</title>
    <link href="<?php echo CSS_PATH?>styles.css" rel="stylesheet" media="all">
</head>
<body>
<?php include("nav.php"); ?>
<form action="<?php echo FRONT_ROOT ?>Calendar/Remove" method="post">
<h1>Calendar Dates List</h1>
<table>
    <thead>
        <th>Date</th>
        <th>Status</th>  
        <th>Set Unavailable</th>        
    </thead>
    <tbody>
        <?php
            foreach($calendarList as $calendar)
            {
                ?>
                    <tr>                        
                        <td><?php echo $calendar->getDate() ?></td>
                        <td><?php echo $calendar->getStatus() ?></td>                 
                        <td><button type="submit" name="id" class="btn" value="<?php echo $calendar->getDate() //// Faltaria definir un Id para cada item del calendario
                        ?>">Set Unavailable </button> </td>                        
                        
                    </tr>
                <?php
            }
        ?>  
        
    </tbody>
        </form>
</table>
<a class="" href="<?php echo FRONT_ROOT ?>Keeper/KeeperLogin">Go back to Dashsboard</a>
</body>
</html>
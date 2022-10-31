<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Preview</title>
    <link href="<?php echo CSS_PATH ?>styles.css" rel="stylesheet" media="all">
</head>

<body>
    <?php include("nav.php"); ?>
    <div class="form-list-view-pet">
        <form action="<?php echo FRONT_ROOT ?>Booking/Add" method="post">
            <h1>Booking Preview</h1>
            <table class="">
                <thead>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Keeper</th>
                    
                </thead>
                <tbody>
                        <tr>
                            <td><?php echo $startDate ?></td>
                            <td><?php echo $endDate ?></td>
                            <td><?php echo $keeperid ?></td>
                            <td>
                            <div class="">
                                <label for="">Select pet</label>
                                <select name="petid">
                                    <?php foreach($petList as $pet)
                                    {
                                        ?>
                                        <option value="<?php echo $pet->getIdPet()?>"><?php echo $pet->getName()?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
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
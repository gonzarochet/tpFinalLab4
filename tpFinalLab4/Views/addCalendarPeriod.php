<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Date Period</title>
    <link href="<?php echo CSS_PATH?>styles.css" rel="stylesheet" media="all">
    <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>
    <?php include("nav.php"); ?>
    
    <section class="calendar-principal">
        <div class="calendar-choise">
            <form action="<?php echo FRONT_ROOT ?>Calendar/Add" method="POST">
                <h1>Add Date Period</h1>
                <div class="form-content-calendar">
                    <label for="">Start Date</label>
                    <input type="date" name="startDate" required min=<?php $hoy=date("Y-m-d"); echo $hoy;?>> 
                </div>
                <div class="form-content-calendar">
                    <label for="">End Date</label>
                    <input type="date" name="endDate" required min=<?php $hoy=date("Y-m-d"); echo $hoy;?>>
                    <span><?php echo @$error?></span>
                </div>
                
                <button type="submit" class="btn-calendar">Add Period</button>

            </form>
            <a class="cancel-register" href="<?php echo FRONT_ROOT ?>Keeper/KeeperLogin">Cancel add period</a>
        </div>

    </section>


</body>

</html>
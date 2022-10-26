<?php

use Models\user as User;
?>


<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Keeper dashboard</title>
     <link href="<?php echo CSS_PATH?>styles.css" rel="stylesheet" media="all">
</head>

<body>
     <?php
     include("nav.php");
     ?>

     <section id="keeper-principal">
          <p id="welcome-message"><?php
                                   $user = new User();
                                   $user = $_SESSION["loggedUser"];
                                   $userName = $user->getFirstName();
                                   echo "Bienvenido $userName - Keeper View"; ?>
          </p>
          <div class="keeper-choise">
               <div class="title-choise">
                    <p>Select Option</p>
               </div>
               <div class="keeper-choise-options">
                    <div id="keeper-button-option">
                         <a href="<?php echo FRONT_ROOT ?>Keeper/AddDates?>"class="btn">Set Available Dates</a>
                    </div>
                    <div id="keeper-button-option">
                         <a href="<?php echo FRONT_ROOT ?>" class="btn">--</a>
                    </div>
                    <div id="keeper-button-option">
                         <a href="<?php echo FRONT_ROOT ?>Keeper/?>" class="btn">--</a>
                    </div>
               </div>
          </div>
     </section>
</body>

</html>
<?php
    $user = $_SESSION["loggedUser"];
    $userName = $user->getFirstName();
    echo "bienvenido $userName";
?>


<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Keeper dashboard</title>
</head>
<body>
<div class="choise-login">
     <div class = card-choise-login>
          <div class = "title-choise-login">
               <p>Select Option</p>
          </div>
          <div class = "choise-login-options">
               <div>
                    <a href="<?php echo FRONT_ROOT ?>Calendar/ShowAddView?>">Set Available Dates</a> 
               </div>
               <div>
                    <a href="<?php echo FRONT_ROOT ?>">--</a>
               </div>
               <div>
                    <a href="<?php echo FRONT_ROOT ?>Keeper/?>">--</a>
               </div>
          </div>
     </div>
</body>

</html>
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
     <title>Choise your profile to Login</title>
</head>
<body>
<div class="choise-login">
     <div class = card-choise-login>
          <div class = "title-choise-login">
               <p>Select Option</p>
          </div>
          <div class = "choise-login-options">
               <div id="button-option-owner">
                    <a href="<?php echo FRONT_ROOT ?>Pet/ShowAddView?>">Agregar Mascota</a> 
               </div>
               <div id="button-option-keeper">
                    <a href="">Consultar listado de keepers</a>
               </div>
          </div>
     </div>
</body>

</html>



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
<?php include("nav.php")?>
<h1>Welcome Keeper <?php
    $user = $_SESSION["loggedUser"];
    $userName = $user->getFirstName();
    echo "$userName";
?>!</h1>
<div class="">

     <div class = card-choise-login>
          
          <div class = "choise-login-options">
               <div>
                    <a href="<?php echo FRONT_ROOT ?>Calendar/ShowAddView?>">Set Available Dates</a> 
               </div>
               <div>
                    <a href="<?php echo FRONT_ROOT ?>Calendar/ShowListView?>">List Available Dates</a>
               </div>
               <div>
                    <a href="<?php echo FRONT_ROOT ?>Keeper/?>">--</a>
               </div>
          </div>
     </div>
</body>

</html>
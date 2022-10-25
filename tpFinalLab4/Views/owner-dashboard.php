
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Owner Dashboard</title>
    <link href="<?php echo CSS_PATH?>styles.css" rel="stylesheet" media="all">
</head>
<body>
<?php include("nav.php")?>
<h1>Welcome Owner <?php
    $user = $_SESSION["loggedUser"];
    $userName = $user->getFirstName();
    echo "$userName";
?>!</h1>
<div class="">
     <div class = card-choise-login>
          
          <div class = "choise-login-options">
               <div id="button-option-owner">
                    <a href="<?php echo FRONT_ROOT ?>Pet/ShowAddView?>">Add Pet</a> 
               </div>
               <div id="button-option-keeper">
                    <a href="<?php echo FRONT_ROOT ?>Pet/ShowPetsByOwner?>">Show my pets</a>
               </div>
               <div id="button-option-keeper">
                    <a href="<?php echo FRONT_ROOT ?>Keeper/ShowListView?>">Show Keepers List</a>
               </div>
          </div>
     </div>
</body>

</html>
<?php
use Models\user as User;
?>


<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Owner Dashboard</title>
     <link href="<?php echo CSS_PATH ?>styles" rel="stylesheet" media="all">
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>
     <?php
     include("nav.php");
     ?>

     <section id="owner-principal">
          <p id="welcome-message"><?php
               $user = new User();
               $user = $_SESSION["loggedUser"];
               $userName = $user->getFirstName();
               echo "Bienvenido $userName - Owner View"; ?></p>
          <div class="owner-choise">
                    <div class="title-choise">
                         <p>Select Option</p>
                    </div>
                    <div class="owner-choise-options">
                         <div id="owner-button-option">
                              <a href="<?php echo FRONT_ROOT ?>Pet/ShowAddView?>"class="btn">Add Pet</a>
                         </div>
                         <div id="owner-button-option">
                              <a href="<?php echo FRONT_ROOT ?>Pet/ShowListPetsByOwner?>"class="btn">Show my pets</a>
                         </div>
                         <div id="owner-button-option">
                              <a href="<?php echo FRONT_ROOT ?>Keeper/ShowListView?>"class="btn">Show Keepers List</a>
                         </div>
                         <div id="owner-button-option">
                              <a href="<?php echo FRONT_ROOT ?>Calendar/ShowAvailableKeepersSearchView?>"class="btn">Search Available Keepers by Date</a>
                         </div>
                         <div id="owner-button-option">
                              <a href="<?php echo FRONT_ROOT ?>Booking/ShowListOwnerView?>"class="btn">Show Bookings</a>
                         </div>
                    </div>
               </div>
     </section>
</body>

</html>
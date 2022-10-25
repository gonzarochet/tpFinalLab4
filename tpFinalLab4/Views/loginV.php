<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Choise your profile to Login</title>
     <link href="<?php echo CSS_PATH?>styles.css" rel="stylesheet" media="all">
</head>

<body>
     <?php include("nav.php"); ?>
     <section id="principal">
          <div class="choise-login">
               <div class="title-choise-login">
                         <p>Login as...</p>
               </div>
               <div class=card-choise-login>
                     <div id="button-option">
                          <a href="<?php echo FRONT_ROOT ?>Owner/OwnerLogin?>">Owner</a>
                    </div>
                    <div id="button-option">
                         <a href="<?php echo FRONT_ROOT ?>Keeper/KeeperLogin?>">Keeper</a>
                    </div>
               </div>
     </section>
</body>

</html>
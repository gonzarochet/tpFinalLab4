<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link href="<?php echo CSS_PATH ?>styles" rel="stylesheet" media="all">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>
<?php include("nav.php"); ?>
     <section id="principal">
          <div class="choise-login">
               <div class="title-choise-login">
                         <p>Please confirm exit application?</p>
               </div>
               <div class=card-choise-login>
                     <div id="button-option">
                          <a href="<?php echo FRONT_ROOT ?>Home/Index?>">Yes, Logout</a>
                    </div>
                    
               </div>
     </section>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
     <link href="<?php echo  CSS_PATH?>styles.css" rel="stylesheet" media="all">
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>   

<body>
<?php include(VIEWS_PATH."nav.php"); ?>
    <div class = "modal">
          <div class = "modal-body">
               <h3><?php echo $message?></h3>
                <a class="btn-list-pet" href="<?php echo FRONT_ROOT ?>User/ShowLoginView">Try Again</a>
          </div>
    </div>
</body>
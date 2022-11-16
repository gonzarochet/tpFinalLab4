<!DOCTYPE html>
<html lang="en">
<head>
     <link href="<?php

use Services\SessionsHelper;

 echo  CSS_PATH?>styles.css" rel="stylesheet" media="all">
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>   

<body>
<?php include(VIEWS_PATH."nav.php"); ?>
    <div class = "modal">
          <div class = "modal-body">
               <h3><?php echo $message?></h3>
               <?php if($flag){?>
                <section class="principal-register">
                    <div class="form-register">
                    <div class="data-visualizer">
                        <h3>Fee</h3>
                        <p><?php echo SessionsHelper::getKeeperSession()->getFee()?></p>
                    </div>
                    <div class="data-visualizer">
                        <h3>Size</h3>
                        <p><?php echo SessionsHelper::getKeeperSession()->getSize()?></p>
                    </div>
                <a class="btn-list-pet" href="<?php echo FRONT_ROOT ?>Keeper/changeDataKeeperView">Accept</a>
            <?php }else{?>
                <a class="btn-list-pet" href="<?php echo FRONT_ROOT ?>Keeper/changeDataKeeperView">Try Again</a>
               <?php }?>
          </div>
    </div>
</body>
<?php

use Models\Owner as Owner;
use Models\User as User;
use MODELS\Keeper as Keeper;
use Services\SessionsHelper;

?>

<header id= "menu">
    <a href="<?php echo FRONT_ROOT ?>"><img src="<?php echo IMAGES_PATH ?>/petHeroLogo" class="logo"></a>
    <h1>Pet Hero</h1>
    <nav>
        <div class=nav-part2>
            <ul class="nav-list">
               <?php
               if(SessionsHelper::sessionUserExist()){
                    $user = new User();
                    $user = SessionsHelper::getUserSession();
                   ?> 
                    <?php if(SessionsHelper::sessionOwnerExist() && SessionsHelper::getSessionType()=="owner"){
                         $owner = new Owner();
                         $owner = SessionsHelper::getOwnerSession();
                    ?>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/changeDataProfile">Edit Profile</a>
                    </li>
                    
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/ChangeType">Change to Keeper</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT ?>Owner/OwnerLogin">Back to Menu</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/Logout">Logout</a>
                    </li>
                    <?php } elseif(SessionsHelper::sessionKeeperExist()&& SessionsHelper::getSessionType()=="keeper"){
                         $keeper = new Keeper();
                         $keeper = SessionsHelper::getKeeperSession();
          
                         ?>
                          
                         <li class="nav-item">
                              <a class="nav-link" href="<?php echo FRONT_ROOT ?>Keeper/changeDataKeeperView">Edit Profile</a>
                         </li>
                         <li class="nav-item">
                              <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/changeType">Change to Owner</a>
                         </li>
                         <li class="nav-item">
                              <a class="nav-link" href="<?php echo FRONT_ROOT ?>Keeper/showDashboardView">Back to Menu</a>
                         </li>

                         <li class="nav-item">
                              <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/Logout">Logout</a>
                         </li>
                    
                <?php }}else{?>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/Index">About</a>
                    </li>
               <?php }?>
            </ul>
        </div>
    </nav>
</header>
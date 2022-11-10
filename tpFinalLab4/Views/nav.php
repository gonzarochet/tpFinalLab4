<?php

use Models\Owner as Owner;
use Models\User as User;
use MODELS\Keeper as Keeper;

?>

<header id= "menu">
    <a href="<?php echo FRONT_ROOT ?>"><img src="<?php echo IMAGES_PATH ?>/petHeroLogo" class="logo"></a>
    <h1>Pet Hero</h1>
    <nav>
        <div class=nav-part2>
            <ul class="nav-list">
               <?php
               if(isset($_SESSION["loggedUser"])){
                    $user = new User();
                    $user = $_SESSION["loggedUser"];
                   ?> 
                    <?php if(isset($_SESSION["loggedOwner"]) && $_SESSION["type"]=="owner"){
                         
                         $owner = new Owner();
                         $owner = $_SESSION["loggedOwner"];
                    ?>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/changeDataProfile">Edit Profile</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/Logout">Notifications</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/ChangeType">Change View</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT ?>Owner/OwnerLogin">Back to Menu</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/Logout">Logout</a>
                    </li>
                    <?php } elseif(isset($_SESSION["loggedKeeper"])&& $_SESSION["type"]=="keeper"){
                         
                         $keeper = new Keeper();
                         $keeper = $_SESSION["loggedKeeper"];
                         ?>
                          <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/Logout">Keeper Option</a>
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
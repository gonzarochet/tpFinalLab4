
<header id= "menu">
    <a href="<?php echo FRONT_ROOT ?>Home/Index"><img src="<?php echo IMAGES_PATH ?>/petHeroLogo" class="logo"></a>
    <h1>Pet Hero</h1>
    <nav>
        <div class=nav-part2>
            <ul class="nav-list">
               <?php
               if(isset($_SESSION["loggedUser"])){
                   ?>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/Logout">Logout</a>
                    </li>
                    <?php if(@$_SESSION["type"]=="owner"){?>


                    <?php }elseif(@$_SESSION["type"]=="keeper"){?>

                    
                <?php }}else{?>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/Index">About</a>
                    </li>
               <?php }?>
                <!--
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/ShowLoginView">Login User</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/ShowListView">List User</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Owner/ShowAddView">Add Owner</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Owner/ShowListView">List Owner</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Keeper/ShowListView">List Keeper</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Pet/ShowAddView">Add Pet</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Pet/ShowListView">List Pets</a>
               </li>
               
               -->
            </ul>
        </div>
    </nav>
</header>
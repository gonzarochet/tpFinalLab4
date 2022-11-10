<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Successfully</title>
    <link href="<?php echo CSS_PATH?>styles.css" rel="stylesheet" media="all">
    <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>
    <?php 
    use Models\User;
    include("nav.php"); 
    $user = new User();
    $user = $_SESSION["loggedUser"];          
    ?>

    <section class="principal-register">
        <div class="form-register">
                <h1>Update Data Successfully</h1>
                <div class="data-visualizer">
                    <h3>Username</h3>
                    <p><?php echo $user->getUsername()?></p>
                </div>
                <div class="data-visualizer">
                    <h3>Email</h3>
                    <p><?php echo $user->getEmail()?></p>
                </div>
                <div class="data-visualizer">
                    <h3>Password</h3>
                    <p><?php echo $user->getPassword()?></p>
                </div>
                <div class="data-visualizer">
                    <h3>First Name</h3>
                    <p><?php echo $user->getFirstName()?></p>
                </div>
                <div class="data-visualizer">
                    <h3>Last Name</h3>
                    <p><?php echo $user->getLastName()?></p>
                </div>
                <div class="data-visualizer">
                    <h3>Date of Birth</h3>
                    <p><?php echo $user->getDateBirth()?></p>
                </div>

                <?php 
                    if(isset($_SESSION["loggedOwner"]) && $_SESSION["type"]=="owner"){ ?>
                        <div class="data-visualizer-buttom">
                            <a class="cancel-register-register" href="<?php echo FRONT_ROOT?>/Owner/OwnerLogin">Back To dashboard </a>
                        </div>
                    <?php }else if(isset($_SESSION["loggedKeeper"]) && $_SESSION["type"]=="keeper"){ ?>
                        <div class="data-visualizer-buttom">
                            <a class="cancel-register-register" href="<?php echo FRONT_ROOT?>/Keeper/KeeperLogin">Back To dashboard </a>
                        </div>
                    <?php } ?>   
            
        </div>


</body>

</html>
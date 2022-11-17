<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change data user</title>
    <link href="<?php echo CSS_PATH?>styles.css" rel="stylesheet" media="all">
    <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>
    <?php 
    use Models\User;
    use Services\SessionsHelper;
    include("nav.php"); 
    $user = new User();
    $user = SessionsHelper::getUserSession();       
    ?>
    <section class="principal-register">
        <div class="form-register">
            <form action="<?php echo FRONT_ROOT ?>User/ChangeDataUser" method="POST">
                <h1>Change any data of your profile</h1>
                <div class="form-content-register">
                    <label for="">Your Actual Username</label>
                    <input type="text" name="username" value= "<?php echo $user->getUsername()?>" placeholder= "<?php echo $user->getUsername()?> "required>
                    <span class="error"><?php echo @$message ?></span>
                </div>
                <div class="form-content-register">
                    <label for="">Enter your Email</label>
                    <input type="text" name="email" value = "<?php echo $user->getEmail()?>" placeholder= "<?php echo $user->getEmail()?> " required>
                    <span class="error"><?php echo @$message ?></span>
                </div>
                <div class = "form-content-register">
                    <label for="">Choise your Password</label>
                    <input type="password" name="password" value = "<?php echo $user->getPassword()?>" placeholder= "<?php echo$user->getPassword()?> "required>
                </div>
                <div class = "form-content-register">
                    <label for="">Enter your First Name</label>
                    <input type="text" name="firstName" value = "<?php echo $user->getFirstName()?>" placeholder= "<?php echo $user->getFirstName()?> ">
                </div>
                <div class = "form-content-register">
                    <label for="">Enter your Last Name</label>
                    <input type="text" name="lastName" value = "<?php echo $user->getLastName()?>" placeholder= "<?php echo $user->getLastName()?> ">
                </div>
                <div class= "form-content-register">
                    <label for="">Enter your date of birth</label>
                    <input type="date" name="dateBirth" value = "<?php echo $user->getDateBirth()?>" placeholder= "<?php echo $user->getDateBirth()?> "max = "<?php $hoy=date("Y-m-d"); echo $hoy;?>" required >
                </div>
                <button type="submit" class="btn">Accept</button>
            </form>
            <?php if(SessionsHelper::sessionOwnerExist()){ ?>
                        <div class="data-visualizer-buttom">
                            <a class="cancel-register-register" href="<?php echo FRONT_ROOT?>/Owner/OwnerLogin">Cancel</a>
                        </div>
                    <?php }else if(SessionsHelper::sessionKeeperExist()){ ?>
                        <div class="data-visualizer-buttom">
                            <a class="cancel-register-register" href="<?php echo FRONT_ROOT?>/Keeper/KeeperLogin">Cancel </a>
                        </div>
                        <?php }?>
        </div>


</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Keeper Data</title>
    <link href="<?php echo CSS_PATH?>styles.css" rel="stylesheet" media="all">
    <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>
    <?php 
    use Models\Keeper;
    use Services\SessionsHelper;
    include("nav.php");          
    ?>
    <section class="principal-register">
        <div class="form-register">
            <form action="<?php echo FRONT_ROOT ?>Keeper/ChangeDataKeeper" method="POST">
                <h1>Change any data of your Keeper Profile</h1>
                <?php if(SessionsHelper::sessionKeeperExist() && SessionsHelper::getSessionType()=="keeper"){?>
                    <h2>Keeper Information</h2>
                    <div class = "form-content-register">
                        <label for="">Choise your new Fee</label>
                        <input type="text" name="fee" value = "<?php echo SessionsHelper::getKeeperSession()->getFee()?>" placeholder= "<?php echo SessionsHelper::getKeeperSession()->getFee()?>" required>
                    </div>
                    <div class = "form-content-register">
                        <label for="">Change to Size Pet to keep</label>
                        <select name="size" value = "<?php echo SessionsHelper::getKeeperSession()->getSize()?>" placeholder= "<?php echo SessionsHelper::getKeeperSession()->getSize()?>">
                            <option value="Small">Small</option>
                            <option value="Medium">Medium</option>
                            <option value="Big">Big</option>
                        </select>
                    </div>
                <?php }?>
                <button type="submit" class="btn">Accept</button>
            </form>
            <a class="cancel-register-register" href="<?php echo FRONT_ROOT ?>Keeper/showDashboardView">Cancel</a>
        </div>


</body>

</html>
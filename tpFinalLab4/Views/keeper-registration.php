<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Keeper</title>
    <link href="<?php echo CSS_PATH?>styles.css" rel="stylesheet" media="all">
    <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
    
</head>

<body>
    <?php include("nav.php"); ?>
    <section id="add-pet-principal">
        <div class="form-add-pet">
            <form action="<?php echo FRONT_ROOT ?>Keeper/RegisterKeeper" method="POST">
                <h1>Register Keeper</h1>
                <div class="form-content-add-pet">
                    <label for="">Fee amount</label>
                    <input type="text" name="fee" required>
                </div>
                <div class="form-content-add-pet">
                    <label for="">Accepted Size</label>
                    <select name="size">
                        <option value="Small">Small</option>
                        <option value="Medium">Medium</option>
                        <option value="Big">Big</option>
                    </select>
                </div>
                <div class="form-content-add-pet-btn">
                    <input type="submit" class="btn" value="Registrar" />
                </div>
            </form>
            <a class="btn-goback" href="<?php echo FRONT_ROOT ?>Keeper/KeeperLogin">Go back</a>
        </div>
    </section>

</body>

</html>
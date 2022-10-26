
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>
    <link href="<?php echo CSS_PATH?>styles.css" rel="stylesheet" media="all">
</head>

<body>
    <?php include("nav.php"); ?>
    <!-- En esta redirección debemos dirigir al HomeController, metodo register para verificar los datos :) -->
    <section class="principal-register">
        <div class="form-register">

            <form action="<?php echo FRONT_ROOT ?>User/Register" method="POST">
                <h1>Register</h1>
                <div class="form-content-register">
                    <label for="">Choise an Username</label>
                    <input type="text" name="username">
                    <span class="error"><?php echo @$message ?></span>
                </div>
                <div class="form-content-register">
                    <label for="">Enter your Email</label>
                    <input type="text" name="email">
                    <span class="error"><?php echo @$message ?></span>
                </div>
                <div class = "form-content-register">
                    <label for="">Choise your Password</label>
                    <input type="password" name="password">
                </div>
                <div class = "form-content-register">
                    <label for="">Enter your First Name</label>
                    <input type="text" name="firstName">
                </div>
                <div class = "form-content-register">
                    <label for="">Enter your Last Name</label>
                    <input type="text" name="lastName">
                </div>
                <div class= "form-content-register">
                    <label for="">Enter your date of birthday </label>
                    <input type="date" name="dateBirth">
                </div>
                <button type="submit" class="btn">Register</button>

            </form>
            <a class="cancel-register-register" href="<?php echo FRONT_ROOT ?>Home/Index">I already have an account</a>
        </div>

    </section>


</body>

</html>
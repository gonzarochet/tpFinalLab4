<?php 
 require_once('nav.php');   
   // $message ="";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>
</head>
<body>
    <!-- En esta redirección debemos dirigir al HomeController, metodo register para verificar los datos :) -->
    <form action = "<?php echo FRONT_ROOT?>Home/Register" method="POST">
        <div>
            <label for = "">Enter Username</label>
            <input type = "text" name = "username">
            <span class = "error"><?php echo $message?></span>
        </div>
        <div>
            <label for = "">Enter your Email</label>
            <input type = "text" name = "email">
            <span class = "error"><?php echo $message?></span>
        </div>
        <div>
            <label for = "">Choise your Password</label>
            <input type = "password" name = "password">
        </div>
        <div>
            <label for="">Enter your First Name</label>
            <input type = "text" name="firstName">
        </div>
        <div>
            <label for="">Enter your Last Name</label>
            <input type = "text" name="lastName">
        </div>
        <div> 
            <label for="">Enter your date of birthday </label>
            <input type = "date" name = "dateBirth">
        </div>
        <button type="submit"  class="btn">Register</button>
    
    </form>

    <a class = "cancel-register" href="<?php echo FRONT_ROOT ?>Home/Index">I already have an account</a>

    
    <!--<a class="" href="<?php echo FRONT_ROOT ?>User/Show">Listar Users</a>-->

    <!-- Coolors Palette Widget -->
    <script src="https://coolors.co/palette-widget/widget.js"></script>
      <script data-id="08938602411245342">new CoolorsPaletteWidget("08938602411245342", ["fefeff","d6efff","fed18c","fed99b","fe654f"]); </script>

</body>
</html>



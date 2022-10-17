<?php

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Owner</title>
</head>
<body>
    <form action = "<?php echo FRONT_ROOT?>Owner/Add" method="POST">
        <div>
            <label for="">Id of Owner</label>
            <input type = "text" name = "id">
        </div>
        <div>
            <label for = "">Username of Owner</label>
            <input type = "text" name = "username">
        </div>
        <div>
            <label for = "">Email of Owner</label>
            <input type = "text" name = "email">
        </div>
        <div>
            <label for = "">Password of Owner</label>
            <input type = "password" name = "password">
        </div>
        <div>
            <label for="">First Name of Owner</label>
            <input type = "text" name="firstName">
        </div>
        <div>
            <label for="">LastName of Owner</label>
            <input type = "text" name="lastName">
        </div>
        <div> 
            <label for=""> Date birth of Owner</label>
            <input type = "date" name = "dateBirth">
        </div>

        <input type="submit" name = "submit" value = "Login">
    </form>
    
    <a class="" href="<?php echo FRONT_ROOT ?>Owner/Show">Listar Owners</a>

    <!-- Coolors Palette Widget -->
    <script src="https://coolors.co/palette-widget/widget.js"></script>
      <script data-id="08938602411245342">new CoolorsPaletteWidget("08938602411245342", ["fefeff","d6efff","fed18c","fed99b","fe654f"]); </script>

</body>
</html>



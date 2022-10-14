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
            <label for="">Dni of Owner</label>
            <input type = "text" name = "dni">
        </div>
        <div>
            <label for = "">Id of Owner</label>
            <input type = "text" name = "id">
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
            <label for="">Age of Owner</label>
            <input type = "text" name = "age">
        </div>
        <div>
            <label for = " ">Username of Owner</label>
            <input type = "text" name = username>
        </div>
        <div>
            <input type="submit" name = "submit" value = "Login">
        </div>
    </form>
    
    <a class="" href="<?php echo FRONT_ROOT ?>Owner/Show">Listar Owners</a>

</body>
</html>



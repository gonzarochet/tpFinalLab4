<?php
    $user = $_SESSION["loggedUser"];
    $userName = $user->getFirstName();
    echo "bienvenido $userName";
?>
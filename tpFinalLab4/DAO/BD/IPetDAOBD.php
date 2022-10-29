<?php

namespace DAO\BD;
use Models\Pet as Pet;

interface IPetDAOBD
{
    function GetAll();
    function Add(Pet $pet);
}
?>
<?php

namespace DAO;
use Models\Pet as Pet;

interface IPetDAOBD
{
    function GetAll();
    function Add(Pet $pet);
}
?>
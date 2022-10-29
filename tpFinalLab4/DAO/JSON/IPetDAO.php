<?php
namespace DAO\JSON;

use Models\Pet;

interface IPetDAO{
    function Add(Pet $pet);
    function getAll(); 
    function GetNextPetId();
}

?>
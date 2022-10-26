<?php namespace DAO;

use Models\Keeper;

interface IKeeperDAO{
    function Add(Keeper $keeper);
    function GetAll();
    function GetKeeperByKeeperId($keeperId);
}



?>
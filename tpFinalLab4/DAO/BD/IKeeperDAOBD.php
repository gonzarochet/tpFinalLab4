<?php
namespace DAO\BD;

use Models\Keeper as Keeper;

interface IKeeperDAOBD
{
    public function GetAll();
    public function Add(Keeper $keeper);
}
?>
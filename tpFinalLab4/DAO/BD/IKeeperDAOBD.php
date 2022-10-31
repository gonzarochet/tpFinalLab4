<?php
namespace DAO\BD;

use Models\Keeper as Keeper;
use Models\User as User;

interface IKeeperDAOBD
{
    public function GetAll();
    public function Add(Keeper $keeper);
    public function UserExistsInKeepers(User $user);
    public function GetKeeperByUserId($userId);
    public function GetKeeperByKeeperId($keeperId);
}
?>
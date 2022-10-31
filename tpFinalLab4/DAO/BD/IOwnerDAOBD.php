<?php
namespace DAO\BD;

use Models\Owner as Owner;
use Models\User as User;

interface IOwnerDAOBD
{
    public function Add(Owner $owner);
    public function GetAll();
    public function UserExistsInOwners(User $user);
    public function GetOwnerByUserId($userId);
    public function GetOwnerByOwnerId($ownerId);
}
?>
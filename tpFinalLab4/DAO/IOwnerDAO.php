<?php
namespace DAO;
use Models\User as User;

interface IOwnerDAO{
    function GetAll();
    function UserExistsInOwners(User $user);
    function GetNextOwnerId();
    function GetOwnerByUserId($userId);
    function GetOwnerByOwnerId($ownerId);
}
?>
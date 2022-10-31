<?php namespace DAO\BD;

    use Models\User as User;    

    interface IUserDAOBD{
        function Add(User $user);
        function GetAll();
        function GetUserByEmail($email);
        function GetUserByUserId($userid);
        function isUsernameExists($username);
        function isEmailExists($email);
    } 
?>
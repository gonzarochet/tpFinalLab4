<?php namespace DAO;

    use Models\User as User;    

    interface IUserDAO{
        function Add(User $user);
        function getAll();
        function GetUserByEmail($email);
    } 


?>
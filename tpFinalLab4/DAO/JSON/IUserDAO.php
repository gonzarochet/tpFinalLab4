<?php namespace DAO\JSON;

    use Models\User as User;    

    interface IUserDAO{
        function Add(User $user);
        function GetAll();
        function GetUserByEmail($email);
    } 


?>
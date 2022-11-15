<?php namespace DAO\BD;

use Models\File as File;

interface IFileDAOBD{

    function Add(File $file);
    function GetAll();

    function GetFileById($idFile);


}


?>
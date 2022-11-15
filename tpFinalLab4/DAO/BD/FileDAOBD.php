<?php namespace DAO\BD;

use Exception;
use Models\File as File;
use DAO\BD\Connection as Connection;


class FileDAOBD implements IFileDAOBD{

    private $connection; 

    public function Add(File $file){
        try{
            $query = "CALL AddFile('".$file->getNameFile()."','".$file->getTypeFile()."','".$file->getSizeFile()."','".$file->getTmpName()."';";
            
            $this->connection::Connection->GetInstance(); 
            $this->connection->ExecuteNonQuery($query);
            
        }catch(Exception $ex){
            throw $ex;
        }
        
    }

    public function GetAll()
    {
        
    }

    public function GetFileById($idFile)
    {
        
    }

}





?>
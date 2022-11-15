<?php namespace DAO\BD;

use Exception;
use Models\File as File;
use DAO\BD\Connection as Connection;


class FileDAOBD implements IFileDAOBD{

    private $connection;

    public function Add(File $file){
        try{
            $query = "CALL AddFile('".$file->getName()."','".$file->getType()."','".$file->getSize()."','".$file->getTmpName()."','".$file->getFullPath()."','".$file->getError()."');";
            
            $this->connection = Connection::GetInstance(); 
            $this->connection->ExecuteNonQuery($query);
            
        }catch(Exception $ex){
            throw $ex;
        }
        
    }

    public function GetFileById($idFile)
    {
        
    }
    public function GetFileByName($FileName)
    {
        try{
        $query = "CALL GetFileByName('".$FileName."');";

        $this->connection=Connection::GetInstance();
        $resultSet = $this->connection->Execute($query);

        $file = new File();

        if(count($resultSet)>0){
            $resultList = $resultSet[0];

            $file->setName($resultList["name"]);
            $file->setType($resultList["type"]);
            $file->setSize($resultList["size"]);
            $file->setError($resultList["error"]);
            $file->setTmpName($resultList["tmp_name"]);
            $file->setFullPath($resultList["fullPath"]);

        }

        return $file;
    }catch(Exception $ex){
        throw $ex;    
    }

    }


}





?>
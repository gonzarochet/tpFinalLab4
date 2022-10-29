<?php

namespace DAO\BD;

use \Exception as Exception;
use DAO\BD\Connection as Connection;
use Models\Owner as Owner;
Use Models\Pet as Pet;
use DAO\BD\IPetDAOBD as IPetDAOBD;

class PetDAOBD implements IPetDAOBD
{
    private $connection;
    private $tableName="pet";

    public function Add(Pet $pet)
    {
        try
        {
            $query="INSERT INTO ".$this->tableName." (name, birthDate, ownerid, vaccinationPlan,picture,size,video,comments) VALUES (:name, :birthDate, :ownerid, :vaccinationPlan, :picture, :size, :video, :comments);";
            $parameters["name"]=$pet->getName();
            $parameters["breed"]=$pet->getBreed();
            $parameters["birthDate"]=$pet->getBirthDate();
            $parameters["ownerid"]=$pet->getOwner()->getOwnerId();
            $parameters["vaccinationPlan"]=$pet->getVaccinationPlan();
            $parameters["picture"]=$pet->getPicture();
            $parameters["size"]=$pet->getSize();
            $parameters["video"]=$pet->getVideo();
            $parameters["comments"]=$pet->getComments();

            $this->connection=Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    public function GetAll()
    {
        $petList=array();
        $query="SELECT * FROM ".$this->tableName;

        $this->connection=Connection::GetInstance();
        $resultSet=$this->connection->Execute($query);

        foreach($resultSet as $row)
        {
            $ownerList = new OwnerDAOBD();
            $owner = new Owner();
            $owner=$ownerList->GetOwnerByOwnerId($row["ownerid"]);


            $pet= new Pet();
            $pet->setIdPet($row["petid"]);
            $pet->setName($row["name"]);
            $pet->setBreed($row["breed"]);
            $pet->setBirthDate($row["birthDate"]);
            $pet->setOwner($owner);
            $pet->setVaccinationPlan($row["vaccinationPlan"]);
            $pet->setPicture($row["picture"]);
            $pet->setSize($row["size"]);
            $pet->setVideo($row["video"]);
            $pet->setComments($row["comments"]);
            
            array_push($petList, $pet);
    
        }
        return $petList;
    }

    public function Remove($id)
        {            
            try
            {
                $query="DELETE FROM ".$this->tableName." WHERE petid= :petid;";
                $parameters["petid"]=$id;

                $this->connection=Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            
        }
 
    
}
?>
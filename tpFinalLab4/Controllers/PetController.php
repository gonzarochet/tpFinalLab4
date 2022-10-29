<?php namespace Controllers;

use Models\Pet as Pet;
//use DAO\PetDAO as PetDAO;
use DAO\BD\PetDAOBD as PetDAOBD;
use Models\Owner as Owner;
//use DAO\OwnerDAO as OwnerDAO;
use DAO\BD\OwnerDAOBD as OwnerDAOBD;

class PetController
{
    private $petDAO;
    private $ownerDAO;

    public function __construct(){
        $this->petDAO = new PetDAOBD();
        $this->ownerDAO = new OwnerDAOBD();
    }

    public function ShowAddView(){
        // aca tengo que levantar el owner id?
        require_once(VIEWS_PATH."add-pet.php");
    }
    public function ShowListView(){
        $petList=$this->petDAO->GetAll();
        $ownerList=$this->ownerDAO->GetAll();
        require_once(VIEWS_PATH."list-pets.php");
    }

    public function Add($name,$birthDate,$vaccinationPlan, $picture,$breed, $size, $video, $comments)
    {
        $user = $_SESSION["loggedUser"];        
        //$owner = new Owner();
        $owner=$this->ownerDAO->GetOwnerByUserId($user->getId()); //lo busco por el user ID en el owner DAO 

        $pet = new Pet();
        //$pet->setIdPet($this->petDAO->GetNextPetId());
        $pet->setName($name);
        $pet->setBirthDate($birthDate);
        $pet->setOwner($owner);
        $pet->setVaccinationPlan($vaccinationPlan);
        $pet->setPicture($picture);
        $pet->setBreed($breed);
        $pet->setSize($size);
        $pet->setVideo($video);
        $pet->setComments($comments);
        
        $this->petDAO->Add($pet);
        
        $this->ShowAddView();
    }

    public function ShowPetsByOwner (){
        
        $user = $_SESSION["loggedUser"];        
        $ownerId=$this->ownerDAO->GetOwnerByUserId($user->getId())->getOwnerId();

        $petList=$this->petDAO->GetAll();
        $ownerPetList= array();

        foreach($petList as $pet)
        {
            if($pet->getOwner()->getOwnerId() == $ownerId)
            {
                array_push($ownerPetList,$pet);
            }
        }
        require_once(VIEWS_PATH."list-pets.php");
    }

    public function Remove($id)
        {
            $this->petDAO->Remove($id);

            $this->ShowPetsByOwner();
        }

}
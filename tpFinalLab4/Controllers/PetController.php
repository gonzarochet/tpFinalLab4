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

    public function ShowListPetsByOwner (){
        
        $user = $_SESSION["loggedUser"];        
        $ownerId=$this->ownerDAO->GetOwnerByUserId($user->getId())->getOwnerId();

        $ownerPetList=$this->petDAO->GetPetsByOwnerId($ownerId);
        
        require_once(VIEWS_PATH."list-pets.php");
    }

    public function Remove($id)
        {
            $this->petDAO->Remove($id);

            $this->ShowListPetsByOwner();
        }

}
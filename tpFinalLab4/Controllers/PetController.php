<?php namespace Controllers;

use Models\Pet as Pet;
use Models\Owner as Owner;
use DAO\PetDAO as PetDAO;
use DAO\OwnerDAO as OwnerDAO;

class PetController
{
    private $petDAO;
    private $ownerDAO;

    public function __construct(){
        $this->petDAO = new PetDAO();
        $this->ownerDAO = new OwnerDAO();
    }

    public function ShowAddView(){
        require_once(VIEWS_PATH."add-pet.php");
    }
    public function ShowListView(){
        $petList=$this->petDAO->GetAll();
        require_once(VIEWS_PATH."list-pets.php");
    }

    public function Add($name,$birthDate, $ownerId,$vaccinationPlan, $picture,$breed)
    {
        $owner = new Owner();
        //Para guardar el objeto owner completo
        $owner->setId($ownerId);
        //$owner = $this->ownerDAO->GetOwnerById($ownerId); //lo busco por el ID en el owner DAO --> Hacer función

        $pet = new Pet();
        $pet->setName($name);
        $pet->setBirthDate($birthDate);
        $pet->setOwner($owner);
        $pet->setVaccinationPlan($vaccinationPlan);
        $pet->setPicture($picture);
        $pet->setBreed($breed);
        //$pet->setVideo($video);
        

        $this->petDAO->Add($pet);
        
        $this->ShowAddView();
    }

}
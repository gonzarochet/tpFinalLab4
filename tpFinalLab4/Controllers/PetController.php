<?php namespace Controllers;

use DAO\BD\FileDAOBD;
use DAO\JSON\PetDAO;
use Models\Pet as Pet;
use Models\File as File;
//use DAO\PetDAO as PetDAO;
use DAO\BD\PetDAOBD as PetDAOBD;
use Models\Owner as Owner;
//use DAO\OwnerDAO as OwnerDAO;
use DAO\BD\OwnerDAOBD as OwnerDAOBD;

class PetController
{
    private $petDAO;
    private $ownerDAO;
    private $FileDAO;


    public function __construct(){
        $this->petDAO = new PetDAOBD();
        $this->ownerDAO = new OwnerDAOBD();
        $this->FileDAO = new PetDAOBD();
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

    public function Add($name,$birthDate, $breed, $size, $comments, $files)
    {
        $user = $_SESSION["loggedUser"];        
        $owner=$this->ownerDAO->GetOwnerByUserId($user->getId()); 

        $pet = new Pet();
        $pet->setName($name);
        $pet->setBirthDate($birthDate);
        $pet->setOwner($owner);

        $pet->setBreed($breed);
        $pet->setSize($size);
        $pet->setComments($comments);

        $fileController = new FileController();

        var_dump($files['picture']);


        if($path_File2 = $fileController->Upload($files["picture"],"vaccination-plan"))
        {
            $pet->setVaccinationPlan($path_File2);
        }
        if($path_File1 = $fileController->Upload($files["vaccinationplan"],"profile-photo-pet"))
        {
            $pet->setPicture($path_File1);
        }
        
        if($path_File3 = $fileController->Upload($files["video"],"video"))
        {
            $pet->setVideo($path_File3);
        }
        
       // $this->petDAO->Add($pet);
        
       // $this->ShowAddView();
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
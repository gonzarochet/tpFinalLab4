<?php namespace Controllers;

use DAO\BD\FileDAOBD;
use DAO\JSON\PetDAO;
use Models\Pet as Pet;
use Models\File as File;
//use DAO\PetDAO as PetDAO;
use DAO\BD\PetDAOBD as PetDAOBD;
/* 
use DAO\JSON\PetDAO as PetDAOBD;        //JSON
use DAO\JSON\OwnerDAO as OwnerDAOBD;    //JSON
*/
use DAO\BD\OwnerDAOBD as OwnerDAOBD;    //BD

use Models\Owner as Owner;
use DAO\BD\BookingDAOBD as BookingDAOBD;

class PetController
{
    private $petDAO;
    private $ownerDAO;
    private $bookingList;



    public function __construct(){
        $this->petDAO = new PetDAOBD();
        $this->ownerDAO = new OwnerDAOBD();
        $this->bookingList = new BookingDAOBD();
    }

    public function ShowAddView(){
        // aca tengo que levantar el owner id?
        require_once(VIEWS_PATH."add-pet.php");
    }
    public function ShowListView($message =""){
        $petList=$this->petDAO->GetAll();
        $ownerList=$this->ownerDAO->GetAll();
        require_once(VIEWS_PATH."list-pets.php");
    }

    public function Add($name,$birthDate, $breed, $size, $comments, $files)
    {
        $user = $_SESSION["loggedUser"];        
        $owner=$this->ownerDAO->GetOwnerByUserId($user->getId()); 
        $owner = new Owner();
        $owner=$this->ownerDAO->GetOwnerByUserId($user->getId()); //lo busco por el user ID en el owner DAO 

        $pet = new Pet();
        $pet->setName($name);
        $pet->setBirthDate($birthDate);
        $pet->setOwner($owner);

        $pet->setBreed($breed);
        $pet->setSize($size);
        $pet->setComments($comments);

        $fileController = new FileController();

        //echo $_FILES["vaccinationPlan"]["name"];

        if($path_File2 = $fileController->Upload($_FILES["vaccinationPlan"],"vaccination-plan"))
        {
            $pet->setVaccinationPlan($path_File2);
        }
        if($path_File1 = $fileController->Upload($_FILES["picture"],"profile-photo-pet"))
        {
            $pet->setPicture($path_File1);
        }
        
        if($path_File3 = $fileController->Upload($_FILES["video"],"video"))
        {
            $pet->setVideo($path_File3);
        }
        $pet->setIsActive('Yes');
        
        $this->petDAO->Add($pet);
        
    }

    public function ShowListPetsByOwner ($message=""){
        
        $user = $_SESSION["loggedUser"];        
        $ownerId=$this->ownerDAO->GetOwnerByUserId($user->getId())->getOwnerId();

        $ownerPetList=$this->petDAO->GetPetsByOwnerId($ownerId);
        
        require_once(VIEWS_PATH."list-pets.php");
    }

    public function DeactivatePet($petid)
        {
            $petBelongsToFutureBooking = $this->bookingList->SearchPetInFutureBookings($petid);
            if($petBelongsToFutureBooking== true){
                $message = "The pet belongs to a current or future booking. You can deactivate it once the related booking is finished.";
                $this->ShowListPetsByOwner($message);
                
            }else{
                $this->petDAO->DeactivatePet($petid);
                $message="Succesfully deactivated";
                $this->ShowListPetsByOwner();
            }
        }
}
?>

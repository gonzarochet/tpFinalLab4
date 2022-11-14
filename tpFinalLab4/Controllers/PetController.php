<?php namespace Controllers;

use Models\Pet as Pet;
//use DAO\PetDAO as PetDAO;
use DAO\BD\PetDAOBD as PetDAOBD;
use Models\Owner as Owner;
//use DAO\OwnerDAO as OwnerDAO;
use DAO\BD\OwnerDAOBD as OwnerDAOBD;
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
        $pet->setIsActive('Yes');
        
        $this->petDAO->Add($pet);
        
        $this->ShowAddView();
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

<?php

namespace Controllers;

use DAO\BD\FileDAOBD;
use DAO\JSON\PetDAO;
use Models\Pet as Pet;
use Models\File as File;

//use DAO\JSON\PetDAO as PetDAOBD;      //JSON 
//use DAO\JSON\OwnerDAO as OwnerDAOBD;    //JSON

use DAO\BD\OwnerDAOBD as OwnerDAOBD;    //BD
use DAO\BD\PetDAOBD as PetDAOBD;        //BD

use Models\Owner as Owner;
use Models\User as User;
use DAO\BD\BookingDAOBD as BookingDAOBD;
use Exception;
use Services\SessionsHelper;

class PetController
{
    private $petDAO;
    private $ownerDAO;
    private $bookingList;



    public function __construct()
    {
        $this->petDAO = new PetDAOBD();
        $this->ownerDAO = new OwnerDAOBD();
        $this->bookingList = new BookingDAOBD();
    }

    public function ShowAddView()
    {
        SessionsHelper::validateSessionOwner();
        require_once(VIEWS_PATH . "add-pet.php");
    }
    public function ShowListView($message = "")
    {
        SessionsHelper::validateSession();
        try{
            $petList = $this->petDAO->GetAll();
            $ownerList = $this->ownerDAO->GetAll();
            require_once(VIEWS_PATH . "list-pets.php");
        }catch(Exception $ex){
            $this->ShowModalAddPet($ex->getMessage());
        }
        
    }

    public function Add($name, $birthDate, $breed, $size, $comments,$video, $vaccinationPlan, $picture)
    {
        SessionsHelper::validateSessionOwner();
        $message = "";
        try {

            $user = new User();
            $user = SessionsHelper::getUserSession();
            $owner = $this->ownerDAO->GetOwnerByUserId($user->getId());

            $pet = new Pet();
            $pet->setName($name);
            $pet->setBirthDate($birthDate);
            $pet->setOwner($owner);
            $pet->setBreed($breed);
            $pet->setSize($size);
            $pet->setComments($comments);
            
            
            $fileController = new FileController();

            //echo $_FILES["vaccinationPlan"]["name"];

            if ($path_File2 = $fileController->Upload($_FILES["vaccinationPlan"], "vaccination-plan")) {
                $pet->setVaccinationPlan($path_File2);
            }
            if ($path_File1 = $fileController->Upload($_FILES["picture"], "profile-photo-pet")) {
                $pet->setPicture($path_File1);
            }
            
            $pet->setVideo($video);
            /*
            if ($path_File3 = $fileController->Upload($_FILES["video"], "video")) {
                $pet->setVideo($path_File3);
            }
            */
            $pet->setIsActive('Yes');

            $this->petDAO->Add($pet);

            $message = "The pet " . $name . " has been upload succesfully";
        } catch (Exception $ex) {
            $message = $ex->getMessage();
        } finally {
            $this->ShowModalAddPet($message);
        }
    }

    private function ShowModalAddPet($message = "")
    {
        require_once(VIEWS_PATH . "/modal/modal-pet.php");
    }

    public function ShowListPetsByOwner($message = "")
    {
        SessionsHelper::validateSession();

        try{
            $user = new User();
            $user = SessionsHelper::getUserSession();
            $ownerId = $this->ownerDAO->GetOwnerByUserId($user->getId())->getOwnerId();
            $ownerPetList = $this->petDAO->GetPetsByOwnerId($ownerId);
            require_once(VIEWS_PATH . "list-pets.php");
        }catch(Exception $ex){
            $this->ShowModalAddPet($ex->getMessage());
        }
    }

    public function ShowModalDeactivatePet($message = ""){
        SessionsHelper::validateSession();
        require_once(VIEWS_PATH . "/modal/modal-pet.php");
    }

    public function DeactivatePet($petid)
    {
        SessionsHelper::validateSessionOwner();
        $message = "";
        try {
            $petBelongsToFutureBooking = $this->bookingList->SearchPetInFutureBookings($petid);
            if ($petBelongsToFutureBooking == true) {
                $message = "The pet belongs to a current or future booking. You can deactivate it once the related booking is finished.";
            } else {
                $this->petDAO->DeactivatePet($petid);
                $message = "Succesfully deactivated";
            }
        } catch (Exception $ex) {
            $message = $ex->getMessage();
        } finally {
            $this->ShowModalAddPet($message);
        }
    }
}

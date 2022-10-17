<?php namespace Controllers;

use Models\User as user;
use Models\Owner as Owner;
use DAO\OwnerDAO AS OwnerDAO;

class OwnerController{
    
    private $ownerDAO;

    public function __construct(){
        $this->ownerDAO = new OwnerDAO();
    }

    public function showAddView(){
        require_once(VIEWS_PATH."loginOwner.php");
    }

    public function showListView(){
        $ownerList = $this->ownerDAO->GetAll();
        require_once(VIEWS_PATH."listOwner.php");
    }
    //the parameters must be in order.
    public function Add(User $user,$petsList){
        
        $owner = new Owner();
        
        $owner->setId($user->getID());
        $owner->setUsername($user->getUsername());
        $owner->setEmail($user->getEmail());
        $owner->setPassword($user->getPassword());
        $owner->setFirstName($user->getFirstName());
        $owner->setLastName($user->getLastName());
        $owner->setDateBirth($user->getDateBirth());
        $owner->setPetsList($petsList);


        $this->ownerDAO->Add($owner);

        $this->showAddView();
    }

    public function Show(){
        $this->showListView();
    }


}



?>
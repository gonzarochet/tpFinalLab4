<?php namespace Controllers;

use Models\User as user;
use Models\Owner as Owner;
use DAO\OwnerDAO AS OwnerDAO;


class OwnerController{
    
    private $ownerDAO;

    public function __construct(){
        $this->ownerDAO = new OwnerDAO();
    }
    public function Index($message = "")
    {
        require_once(VIEWS_PATH."home.php");
    }

    public function showAddView(){
        require_once(VIEWS_PATH."addOwner.php");
    }

    public function showListView(){
        $ownerList = $this->ownerDAO->GetAll();
        require_once(VIEWS_PATH."listOwner.php");
    }
    //the parameters must be in order.
    public function Add(User $user){
        
        $owner = new Owner();

        $owner->setOwnerId($this->ownerDAO->GetNextOwnerId()); 
        $owner->setUser($user);

        $this->ownerDAO->Add($owner);

    }

    public function Show(){
        $this->showListView();
    }

    public function OwnerLogin(){
        require_once(VIEWS_PATH."validate-session.php");
        $user=$_SESSION["loggedUser"];
        
        // Validate if owner already exists with this user. 
        $userExistsInOwners = $this->ownerDAO->UserExistsInOwners($user);
        
        
        if ($userExistsInOwners) // If exists --> shows owner dashboard
        {
            // necesito levantar el owner id?
            require_once(VIEWS_PATH."owner-dashboard.php");

        }else  //If not it creates the owner with the add function. 
        {
            $this->Add($user);
            require_once(VIEWS_PATH."owner-dashboard.php");
        }
       
       



    }


}



?>
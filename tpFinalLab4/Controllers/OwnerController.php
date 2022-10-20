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

        
        $owner->setOwnerId(1); //Function get Next id
        $owner->setUser($user);


        $this->ownerDAO->Add($owner);

        //$this->showAddView();
        //Redirect to dashboard with owner view.
    }

    public function Show(){
        $this->showListView();
    }

    public function OwnerLogin(){
        require_once(VIEWS_PATH."validate-session.php");
        
        if($_SESSION["loggedUser"]){
            $user = $_SESSION["loggedUser"];
            
           




        }else{
            $this->Index("You must be logged");
        }
        
        
      

        // Validate if owner already exists with this user. If not it creates it with the add function. 
        $this->Add($user);



    }


}



?>
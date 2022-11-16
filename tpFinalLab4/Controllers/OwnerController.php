<?php namespace Controllers;


//use DAO\JSON\OwnerDAO AS OwnerDAOBD; //JSON
use DAO\BD\OwnerDAOBD AS OwnerDAOBD;    //BD

use Models\User as user;
use Models\Owner as Owner;
use Services\PHPMailer\Exception;
use Services\SessionsHelper;

class OwnerController{
    
    private $ownerDAO;

    public function __construct(){
        $this->ownerDAO = new OwnerDAOBD();
    }

    public function showListView(){
        $ownerList = $this->ownerDAO->GetAll();
        require_once(VIEWS_PATH."listOwner.php");
    }
    //the parameters must be in order.
    private function Add(User $user){
        
        $owner = new Owner();
        //$owner->setOwnerId($this->ownerDAO->GetNextOwnerId()); --> quedó definido en el dao
        $owner->setUser($user);

        $this->ownerDAO->Add($owner);

    }

    public function ShowModalOwner($message = "")
    {
        require_once(VIEWS_PATH . "/modal/modal-owner.php");
    }

    public function OwnerLogin(){

        $flag = false;

        $message="";

        SessionsHelper::validateSession();
        $user=SessionsHelper::getUserSession();

        try{
        // Validate if owner already exists with this user. 
        $userExistsInOwners = $this->ownerDAO->UserExistsInOwners($user);
        
        if ($userExistsInOwners) // If exists --> shows owner dashboard
        {
            // necesito levantar el owner id?
            SessionsHelper::initOwnerSession($this->ownerDAO->GetOwnerByUserId($user->getId()));
            require_once(VIEWS_PATH."owner-dashboard.php");

        }else  //If not it creates the owner with the add function. 
        {
            $this->Add($user);
            SessionsHelper::initOwnerSession($this->ownerDAO->GetOwnerByUserId($user->getId()));
            require_once(VIEWS_PATH."owner-dashboard.php");
        } 
    }catch(Exception $ex){
        $this->ShowModalOwner($ex->getMessage());
    }
    
    }

}

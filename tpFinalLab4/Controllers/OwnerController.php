<?php namespace Controllers;

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
    public function Add($dni,$id,$firstName,$lastName,$age,$username){
        
        $owner = new Owner($dni,$id,$firstName,$lastName,$age,$username);
        /*$owner = new Owner("","","","","","");
        $owner->setId($id);
        $owner->setDni($dni);
        $owner->setFirstName($firstName);
        $owner->setLastName($lastName);
        $owner->setAge($age);
        $owner->setUsername($username);*/

        

        $this->ownerDAO->Add($owner);

        $this->showAddView();
    }

    public function Show(){
        $this->showListView();
    }


}



?>
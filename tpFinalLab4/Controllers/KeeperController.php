<?php namespace Controllers;

use Models\User as User;
use Models\Keeper as Keeper;
//use DAO\KeeperDAO as KeeperDAO;
use DAO\BD\KeeperDAOBD as KeeperDAOBD;
use Models\Calendar as Calendar;


class KeeperController{
    private $keeperDAO;

    public function __construct(){
        $this->keeperDAO = new KeeperDAOBD();
    }

    public function Index($message = ""){
        require_once(VIEWS_PATH."home.php");
    }
    
    public function showAddView(){}

    public function showListView(){
        $keeperList = $this->keeperDAO->GetAll();
        require_once(VIEWS_PATH."listKeeper.php");
    }

    /*public function showListViewbyOwner(){   //para que estaba esta función??
        $keeperList = $this->keeperDAO->GetAll();
        require_once(VIEWS_PATH."listKeeperOwnerView.php");
    }*/

    public function Add(User $user, $fee, $size){

        $keeper = new Keeper();

        $keeper->setUser($user);   //el id se setea en el DAO para json - $keeper->setKeeperId($this->keeperDAO->GetNextKeeperId())
        $keeper->setReputation(0);
        $keeper->setFee($fee);
        $keeper->setSize($size);

        $this->keeperDAO->Add($keeper);
    }

    public function KeeperLogin(){
        require_once(VIEWS_PATH."validate-session.php");

        $user = $_SESSION["loggedUser"];

        $userExistsInKeepers = $this->keeperDAO->UserExistsInKeepers($user);

        if($userExistsInKeepers){
            $_SESSION["loggedKeeper"]=$this->keeperDAO->GetKeeperByUserId($user->getId());
            $_SESSION["type"] = "keeper";
            require_once(VIEWS_PATH."keeper-dashboard.php");
        }else{
           //$this->Add($user);
            //$_SESSION["loggedKeeper"]=$this->keeperDAO->GetKeeperByUserId($user->getId());
            require_once(VIEWS_PATH."keeper-registration.php");
        }
    }

    public function RegisterKeeper($fee, $size)
    {
        $user = $_SESSION["loggedUser"];
        
        $this->Add($user,$fee,$size);
        $_SESSION["loggedKeeper"]=$this->keeperDAO->GetKeeperByUserId($user->getId());
        $_SESSION["type"] = "keeper";
        require_once(VIEWS_PATH."keeper-dashboard.php");

    }
   

    

    




}




?>
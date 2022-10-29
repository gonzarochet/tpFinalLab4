<?php namespace Controllers;

use Models\User as User;
use Models\Keeper as Keeper;
//use DAO\KeeperDAO as KeeperDAO;
use DAO\BD\KeeperDAOBD as KeeperDAOBD;


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
        $keeperList = $this->keeperDAO->getAll();
        require_once(VIEWS_PATH."listKeeper.php");
    }
    public function showListViewbyOwner(){
        $keeperList = $this->keeperDAO->getAll();
        require_once(VIEWS_PATH."listKeeperOwnerView.php");
    }

    public function Add(User $user){

        $keeper = new Keeper();

        //$keeper->setKeeperId($this->keeperDAO->GetNextKeeperId()); --> el id se setea en el DAO para json
        $keeper->setUser($user);
        $keeper->setReputation(0);

        $this->keeperDAO->Add($keeper);
    }

    public function KeeperLogin(){
        require_once(VIEWS_PATH."validate-session.php");

        $user = $_SESSION["loggedUser"];

        $userExistsInKeepers = $this->keeperDAO->UserExistsInKeepers($user);

        if($userExistsInKeepers){
            $_SESSION["loggedKeeper"]=$this->keeperDAO->GetKeeperByUserId($user->getId());
            require_once(VIEWS_PATH."keeper-dashboard.php");
        }else{
            $this->Add($user);
            $_SESSION["loggedKeeper"]=$this->keeperDAO->GetKeeperByUserId($user->getId());
            require_once(VIEWS_PATH."keeper-dashboard.php");
        }
    }

    




}




?>
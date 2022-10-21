<?php namespace Controllers;

use Models\User as User;
use Models\Keeper as Keeper;
use DAO\KeeperDAO as KeeperDAO;


class KeeperController{
    private $keeperDAO;

    public function __construct(){
        $this->keeperDAO = new KeeperDAO();
    }

    public function Index($message = ""){
        require_once(VIEWS_PATH."home.php");
    }
    
    public function showAddView(){}

    public function showListView(){
        $keeperList = $this->keeperDAO->getAll();
        require_once(VIEWS_PATH."listKeeper.php");
    }

    public function Add(User $user){

        $keeper = new Keeper();

        $keeper->setKeeperId($this->keeperDAO->GetNextKeeperId());
        $keeper->setUser($user);
        $keeper->setReputation("");

        $this->keeperDAO->Add($keeper);
    }

    public function KeeperLogin(){
        require_once(VIEWS_PATH."validate-session.php");

        $user = $_SESSION["loggedUser"];

        $userExistsInKeepers = $this->keeperDAO->UserExistsInKeepers($user);

        if($userExistsInKeepers){
            require_once(VIEWS_PATH."keeper-dashboard.php");
        }else{
            $this->Add($user);
            require_once(VIEWS_PATH."keeper-dashboard.php");
        }
    }




}




?>
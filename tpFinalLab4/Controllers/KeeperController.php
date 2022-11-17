<?php namespace Controllers;

//use DAO\JSON\KeeperDAO as KeeperDAOBD;  //JSON
use DAO\BD\KeeperDAOBD as KeeperDAOBD;    //BD
use Exception;
use Models\User as User;
use Models\Keeper as Keeper;
use Services\SessionsHelper;

class KeeperController{
    private $keeperDAO;

    public function __construct(){
        $this->keeperDAO = new KeeperDAOBD();
    }

    public function Index($message = ""){
        require_once(VIEWS_PATH."home.php");
    }
    
    public function showDashboardView()
    {
        SessionsHelper::validateSessionKeeper();
        require_once(VIEWS_PATH."keeper-dashboard.php");
    }

    public function showRegistrationView(){
        SessionsHelper::validateSession();
        require_once(VIEWS_PATH."keeper-registration.php");

    }

    public function showListView(){
        $keeperList = $this->keeperDAO->GetAll();
        require_once(VIEWS_PATH."listKeeper.php");
    }


    private function Add(User $user, $fee, $size){

        $keeper = new Keeper();

        $keeper->setUser($user);   //el id se setea en el DAO para json - $keeper->setKeeperId($this->keeperDAO->GetNextKeeperId())
        $keeper->setReputation(0);
        $keeper->setFee($fee);
        $keeper->setSize($size);

        $this->keeperDAO->Add($keeper);
    }

    private function ShowModalKeeperLogin($message = "")
    {
        require_once(VIEWS_PATH . "/modal/modal-keeper-login.php");
    }

    public function KeeperLogin(){

        $message = "";
        SessionsHelper::validateSession();
        try{
        $user = SessionsHelper::getUserSession();

        $userExistsInKeepers = $this->keeperDAO->UserExistsInKeepers($user);

        if($userExistsInKeepers){
            SessionsHelper::initKeeperSession($this->keeperDAO->GetKeeperByUserId($user->getId()));
            require_once(VIEWS_PATH."keeper-dashboard.php");
        }else{
            require_once(VIEWS_PATH."keeper-registration.php");
        }
        }catch(Exception $ex){
            $this->ShowModalKeeperLogin($ex->getMessage());
        }
    }

    private function ShowModalKeeperRegister($message = "",$flag)
    {
        require_once(VIEWS_PATH . "/modal/modal-keeper-register.php");
    }

    public function RegisterKeeper($fee, $size)
    {
        SessionsHelper::validateSession();
        $message = "";
        $flag = false;

        try{
            $user = SessionsHelper::getUserSession();
            $this->Add($user,$fee,$size);
            SessionsHelper::initKeeperSession($this->keeperDAO->GetKeeperByUserId($user->getId()));
            $message = "Keeper registration succesfully";
            $flag = true;
            //require_once(VIEWS_PATH."keeper-dashboard.php");

        }catch(Exception $ex){
            $message = $ex->getMessage();
            
        }finally{
            $this->ShowModalKeeperRegister($message, $flag);
        }

    }

    public function changeDataKeeperView()
    {
        SessionsHelper::validateSession();
        require_once(VIEWS_PATH . "change-data-keeper.php");
    }

    private function ShowModalKeeperUpdate($message = "",$flag)
    {
        require_once(VIEWS_PATH . "/modal/modal-keeper-update.php");
    }

    public function changeDataKeeper($fee,$size)
    {
        $message = "";
        $flag = false;
        SessionsHelper::validateSessionKeeper();
        $keeper = new Keeper();
        $keeper = SessionsHelper::getKeeperSession();
        try {
                $this->keeperDAO->updateKeeper($keeper->getKeeperId(),$fee,$size);
                $message="Data Keeper update succesfully";
                $flag = true;
        } catch (Exception $ex) {
           $message = $ex->getMessage();
        }finally{
            $this->ShowModalKeeperUpdate($message,$flag);
        }
    }

}




?>
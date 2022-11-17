<?php namespace Controllers;

use Models\Calendar as Calendar;
//use DAO\CalendarDAO AS CalendarDAO;
use DAO\BD\CalendarDAOBD as CalendarDAOBD;
use DAO\BD\PetDAOBD as PetDAOBD;
use DAO\BD\KeeperDAOBD;
use DateTime as DateTime;
use DateInterval as DateInterval;
use DatePeriod as DatePeriod;
use \Exception as Exception;
use Services\SessionsHelper;

class CalendarController{
    
    private $calendarDAO;

    public function __construct(){
        $this->calendarDAO = new CalendarDAOBD();
    }

    public function ShowAddView(){
        SessionsHelper::validateSession();
        require_once(VIEWS_PATH."addCalendarPeriod.php");
    }

    //En lugar de usar ShowListView, usamos directamente el ShowListViewByKeeper, de lo contrario un keeper vería la lista de fechas de todos los demas.
    public function ShowListViewByKeeper(){
        $keeper= SessionsHelper::getKeeperSession();
        $calendarList = $this->calendarDAO->GetAllByKeeper($keeper);
        require_once(VIEWS_PATH."listCalendarPeriod.php");
    }

    public function Add( $startDate, $endDate){

        SessionsHelper::validateSession();

        if($endDate<$startDate){
            $error = "The end date is incorrect, please insert a correct date";
            require_once(VIEWS_PATH."addCalendarPeriod.php");
        }else{

            $keeper=SessionsHelper::getKeeperSession(); 

            $interval = new DateInterval('P1D');  // Variable that store the date interval of period 1 day
            $end = new DateTime($endDate);
            $end->add($interval);
      
            $period = new DatePeriod(new DateTime($startDate), $interval, $end); //Creation of the period

            $flag = $this->calendarDAO->IsPeriodExist($period,$keeper);// check that the period exist

            if($flag){
                $error = "You already have the selected dates in your selection. Please change the dates and try again";
                require_once(VIEWS_PATH."addCalendarPeriod.php");
            }else{
                
                foreach($period as $date) {                                         //Add EACH day as CalendarItem to CalendarDAO
    
                    $calendarItem= new Calendar(); 
    
                    $calendarItem->setKeeper($keeper); 
                    $calendarItem->setDate($date->format('Y-m-d'));
                    $calendarItem->setStatus("Available");
    
                    $this->calendarDAO->Add($calendarItem);
                }
    
            $this->ShowListViewByKeeper();//To show the recently added items
            }
             
        }
                                                
    }

    public function RemoveDate($id)
    {
        SessionsHelper::validateSession();

        $this->calendarDAO->RemoveDate($id);
        $this->ShowListViewByKeeper();
    }

    /*
    This function allows to enter the start date, end date and selected pet, that will be used to found
    available keepers that can keep the required size in those dates.
    */
    public function ShowAvailableKeepersSearchView()
    {
        $owner=SessionsHelper::getOwnerSession();
        $petList=new PetDAOBD();
        $petList=$petList->GetActivePetsByOwnerId($owner->getOwnerId()); //only shows active pets
        require_once(VIEWS_PATH."searchAvailableKeepers.php");
    }

    public function ShowAvailableKeepers($startDate, $endDate, $petid)
    {
        SessionsHelper::validateSessionOwner();
        $message = "";
        $flag = false;

        try{

        $petList=new PetDAOBD();
        $pet=$petList->GetPetByPetId($petid);

        if($endDate<$startDate){
            $message = "The end date is incorrect, please insert a correct date";
            $this->ListAvailableKeepers($message,$flag); 
        }else{
            $keeperList = $this->SearchAvailableKeepers($startDate, $endDate, $pet->getSize());
            if($keeperList){
                $flag = true;
                $message = "We found Keepers availables for you";
                require_once(VIEWS_PATH."listAvailableKeepers.php");
            }else{
                $message = "Don't available keepers in the dates that you required";
                $this->ListAvailableKeepers($message,$flag);
            }
        }
        }catch(Exception $ex){
            $message = $ex->getMessage();
        }
    }

    public function ListAvailableKeepers($message="",$flag=""){
        SessionsHelper::validateSessionOwner();
        require_once(VIEWS_PATH."listAvailableKeepers.php");
        
    }


    private function SearchAvailableKeepers($startDate, $endDate, $size)
    {

        try{
        $requiredInterval = new DateInterval('P1D'); 
        $end = new DateTime($endDate);
        $end->add($requiredInterval);
        

        $requiredPeriod = new DatePeriod(new DateTime($startDate), $requiredInterval, $end); //List of required days
        
        $keepersList = new KeeperDAOBD();
        $keepersList = $keepersList->getAll(); //Brings all keepers
        $availableKeepersList = array();

        foreach ($keepersList as $keeper) {
            $availableCalendarByKeeperList = $this->calendarDAO->AvailableDatesByKeeper($keeper); //Brings all available days per keeper (the date has to exist and has to have status='Available' to appear here)

            $available = true;
            foreach ($requiredPeriod as $day) {
                
                if ((!in_array($day, $availableCalendarByKeeperList))) //if at least 1 day it's not available, then turn unavailable.
                {
                    $available = false;
                }
            }


            if ($available == true  && (SessionsHelper::getUserSession() != $keeper->getUser()) && $keeper->getSize()==$size) //if it's still available after checking all dates, 
            {                                                                                     // and it's not the same user as the logged Owner (Owner and Keeper can't be the same in 1 booking)
                array_push($availableKeepersList, $keeper);                                         // then it's pushed into the array
            }
        }
        return $availableKeepersList; 
        } 
        catch(Exception $ex){
            throw $ex;
        }               
    }      
    
    
}

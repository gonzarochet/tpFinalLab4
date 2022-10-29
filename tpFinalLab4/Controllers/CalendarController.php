<?php namespace Controllers;

use Models\Calendar as Calendar;
//use DAO\CalendarDAO AS CalendarDAO;
use DAO\BD\CalendarDAOBD as CalendarDAOBD;
use DateTime as DateTime;
use DateInterval as DateInterval;
use DatePeriod as DatePeriod;
use FTP\Connection;

class CalendarController{
    
    private $calendarDAO;

    public function __construct(){
        $this->calendarDAO = new CalendarDAOBD();
    }

    public function ShowAddView(){
        require_once(VIEWS_PATH."addCalendarPeriod.php");
    }

    public function ShowListView(){
        $calendarList = $this->calendarDAO->GetAll();
        require_once(VIEWS_PATH."listCalendarPeriod.php");
    }

    public function ShowListViewByKeeper(){
        $keeper= $_SESSION["loggedKeeper"];
        $calendarList = $this->calendarDAO->GetAllByKeeper($keeper);
        require_once(VIEWS_PATH."listCalendarPeriod.php");
    }

    public function Add( $dateFrom, $dateTo){

        $keeper=$_SESSION['loggedKeeper']; 

        $interval = new DateInterval('P1D');  // Variable that store the date interval of period 1 day
        $end = new DateTime($dateTo);
        $end->add($interval);
  
        $period = new DatePeriod(new DateTime($dateFrom), $interval, $end); //Creation of the period
  
        // 
        foreach($period as $date) {                                         //Add EACH day as CalendarItem to CalendarDAO

            $calendarItem= new Calendar();

            $calendarItem->setKeeper($keeper); 
            $calendarItem->setDate($date->format('Y-m-d'));
            $calendarItem->setStatus("Available");

            $this->calendarDAO->Add($calendarItem);
        }

        $this->ShowListView();                                              //To show the recently added items
    }

    public function Remove($id)
        {
            $this->calendarDAO->Remove($id);
 
            $this->ShowListView();
        }

    
        
}
?>
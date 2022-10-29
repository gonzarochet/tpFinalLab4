<?php namespace Controllers;

use Models\Calendar as Calendar;
use DAO\BD\CalendarDAO AS CalendarDAO;
use DateTime as DateTime;
use DateInterval as DateInterval;
use DatePeriod as DatePeriod;


class CalendarController{
    
    private $calendarDAO;

    public function __construct(){
        $this->calendarDAO = new CalendarDAO();
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

        $interval = new DateInterval('P1D');  // Variable that store the date interva of period 1 day
        $end = new DateTime($dateTo);
        $end->add($interval);
  
        $period = new DatePeriod(new DateTime($dateFrom), $interval, $end);
  
        // Use loop to store date
        foreach($period as $date) {     

            $calendarItem= new Calendar();

            $calendarItem->setKeeper($keeper); 
            $calendarItem->setDate($date->format('Y-m-d'));
            $calendarItem->setStatus("Available");

            $this->calendarDAO->Add($calendarItem);
             
        }
    }
        
}
?>
<?php

namespace DAO\JSON;

use Models\Calendar as Calendar;
use DAO\JSON\ICalendarDAO as ICalendarDAO;
use Models\Keeper as Keeper;
use DAO\JSON\KeeperDAO as KeeperDAO;


class CalendarDAO implements ICalendarDAO
{
    private $calendarList;
    private $keeperList;

    public function __construct()
    {
        $this->calendarList= array();
        $this->keeperList=new KeeperDAO();
    }

    public function Add(Calendar $calendar){
        $this->RetrieveData();
        array_push($this->calendarList,$calendar);
        $this->SaveData();
    }

    public function getAll(){
        $this->RetrieveData();
        return $this->calendarList;
    }

    private function RetrieveData(){
        $this->calendarList = array();

        if(file_exists('Data/calendar.json')){
            $jsonContent = file_get_contents('Data/calendar.json');
            
            $arraytoDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();
            
            foreach($arraytoDecode as $valuesArray){
                //Busco el objeto keeper en el DAO por keeperId
                $keeper = new Keeper();                    
                
                $keeper = $this->keeperList->GetKeeperByKeeperId($valuesArray["keeperId"]);
                
                $calendar = new Calendar();
                $calendar->setKeeper($keeper);
                $calendar->setDate($valuesArray["date"]);
                $calendar->setStatus($valuesArray["status"]);

                array_push($this->calendarList, $calendar);
            }
        }
    }

    private function SaveData(){
        $arraytoEncode = array();

        foreach($this->calendarList as $calendar){

            //var_dump($calendar);
            
            $valuesArray["keeperId"] = $calendar->getKeeper()->getKeeperId();
            $valuesArray["date"]=$calendar->getDate();
            $valuesArray["status"]=$calendar->getStatus();

            array_push($arraytoEncode,$valuesArray);
        }
        $jsonContent = json_encode($arraytoEncode, JSON_PRETTY_PRINT);

        file_put_contents('Data/calendar.json',$jsonContent);        
    }

    public function GetAllByKeeper($keeper)
    {
        $this->RetrieveData();
        $keeperCalendarList = array();

        foreach ($this->calendarList as $calendarItem)
        {
            if($calendarItem->getKeeper() == $keeper)
            {
                array_push($keeperCalendarList, $calendarItem);
            }
        }
        return $keeperCalendarList;

    }
}
?>
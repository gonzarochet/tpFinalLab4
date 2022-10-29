<?php

namespace Models;

use Models\Keeper as Keeper;

class Calendar
{
    private $calendarId;
    private $keeper;
    private $date;
    private $status;

    public function getCalendarId()
    {
        return $this->calendarId;
    }
    public function setCalendarId($calendarId)
    {
        $this->calendarId=$calendarId;
    }

    public function getKeeper(){
        return $this->keeper;
    }
    public function setKeeper(Keeper $keeper){
        $this->keeper=$keeper;
    }

    public function getDate(){
        return $this->date;
    }
    public function setDate($date){
        $this->date=$date;
    }
    public function getStatus(){
        return $this->status;
    }
    public function setStatus($status){
        $this->status=$status;
    }

}
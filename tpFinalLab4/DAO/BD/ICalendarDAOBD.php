<?php

namespace DAO\BD;

use Models\Calendar as Calendar;
use Models\Keeper as Keeper;

interface ICalendarDAOBD
{
    public function GetAll();
    public function Add(Calendar $calendar);
    public function GetAllByKeeper(Keeper $keeper);
    public function Remove($id);
    public function AvailableDatesByKeeper(Keeper $keeper);
    public function SetDatesUnavailable($keeperid, $startDate, $endDate);
}
?>
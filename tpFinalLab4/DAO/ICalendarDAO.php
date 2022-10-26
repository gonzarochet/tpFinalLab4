<?php namespace DAO;

use Models\Calendar as Calendar;
use Models\Keeper as Keeper;

interface ICalendarDAO{
    function Add(Calendar $calendar);
    function GetAll();
    function GetAllByKeeper(Keeper $keeper);
}
?>
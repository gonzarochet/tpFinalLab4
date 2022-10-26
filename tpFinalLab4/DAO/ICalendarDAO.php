<?php namespace DAO;

use Models\Calendar as Calendar;

interface ICalendarDAO{
    function Add(Calendar $calendar);
    function GetAll();
    function GetAllByKeeper(Keeper $keeper);
}
?>
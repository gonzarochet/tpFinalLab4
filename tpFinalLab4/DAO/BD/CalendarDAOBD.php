<?php
namespace DAO\BD;

use Models\Calendar as Calendar;
use DAO\BD\ICalendarDAOBD AS ICalendarDAOBD;
use \Exception as Exception;
use DAO\BD\Connection as Connection;
use DateTime as DateTime;
use DateInterval as DateInterval;
use DatePeriod as DatePeriod;
use Models\Keeper;

class CalendarDAOBD
{
    private $connection;
    private $tableName="calendar";

    public function Add($calendar)
    {
        try {
            $query="INSERT INTO ".$this->tableName." (keeperid, calendarDate, status) VALUES (:keeperid, :calendarDate, :status);";

            $parameters["keeperid"]=$calendar->getKeeper()->getKeeperId();
            $parameters["calendarDate"]=$calendar->getDate();
            $parameters["status"]=$calendar->getStatus();

            $this->connection=Connection::GetInstance();
            $this->connection->Execute($query,$parameters);

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAll()
    {
        try 
        {
            $calendarList = array();
            $query="SELECT * FROM ".$this->tableName;

            $this->connection=Connection::GetInstance();
            $resultSet=$this->connection->Execute($query);

            foreach($resultSet as $row)
            {
                $keeperList=new KeeperDAOBD();
                $calendar= new Calendar();
                $calendar->setCalendarId($row["calendarid"]);
                $calendar->setDate($row["calendarDate"]);
                $calendar->setStatus($row["status"]);
                $calendar->setKeeper($keeperList->getKeeperbyKeeperId($row["keeperid"]));

                array_push($calendarList, $calendar);
            }
            return $calendarList;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAllByKeeper($keeper)
    {
        try 
        {
            $query="SELECT * FROM ".$this->tableName." WHERE keeperid = :keeperid ;";
            $parameters["keeperid"]=$keeper->getKeeperId();

            $this->connection=Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            $calendarList=array();
            foreach ($resultSet as $row)
            {
                $keeperList = new KeeperDAOBD();
                $calendarItem=new Calendar();
                $calendarItem->setKeeper($keeperList->GetKeeperByKeeperId($row["keeperid"]));
                $calendarItem->setCalendarId($row["calendarid"]);
                $calendarItem->setDate($row["calendarDate"]);
                $calendarItem->setStatus($row["status"]);

                array_push($calendarList, $calendarItem);
            }
            return $calendarList;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function RemoveDate($id)
    {
        try 
        {
            $query="DELETE FROM ".$this->tableName." WHERE calendarid= :calendarid ;";
            $parameters["calendarid"]=$id;

            $this->connection= Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);            

        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function AvailableDatesByKeeper($keeper)
    {
        try 
        {
            $query="SELECT * FROM ".$this->tableName." WHERE status='Available' and keeperid= :keeperid ;";
            $parameters["keeperid"]=$keeper->getKeeperId();

            $this->connection= Connection::GetInstance();
            $resultSet=$this->connection->Execute($query, $parameters);  
            
            $datesByKeeperList=array();
            foreach($resultSet as $row)
            {
                $dateDay = new DateTime($row["calendarDate"]);
                array_push($datesByKeeperList,$dateDay);
            }
            return $datesByKeeperList;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function IsPeriodExist(DatePeriod $period,Keeper $keeper){
        $flag = false;
        try{
            $query = "SELECT * FROM ".$this->tableName." WHERE calendarDate = :calendarDate and keeperid = :keeperid ;";
            
            foreach($period as $date){
                                
                $parameters["calendarDate"] = $date->format("Y-m-d");
                $parameters["keeperid"] = $keeper->getkeeperId();

                $this->connection=Connection::GetInstance();
                $result=$this->connection->Execute($query, $parameters);  

                if($result){
                    $flag = true;
                }

            }
            
        }catch (Exception $ex){
            throw $ex;
        }
        return $flag;
    }

    public function SetDatesUnavailable($keeperid, $startDate, $endDate){
        //Interval definition
        $interval = new DateInterval('P1D'); 
        $end = new DateTime($endDate);
        $end->add($interval);

        $period = new DatePeriod(new DateTime($startDate), $interval, $end); //List of days

        foreach ($period as $day)
        {
            try
            {
                $query="UPDATE ".$this->tableName." SET status = 'Unavailable' WHERE keeperid=:keeperid and calendarDate= :calendarDate ;";
                $parameters["keeperid"]=$keeperid;
                $parameters["calendarDate"]=$day->format('Y-m-d'); //Converting to String to be able to compare the date in the DB

                $this->connection=Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query,$parameters);

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }


}
?>
<?php
namespace DAO\BD;

use Models\Calendar as Calendar;
use DAO\BD\ICalendarDAOBD AS ICalendarDAOBD;
use \Exception as Exception;
use DAO\BD\Connection as Connection;

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

    public function Remove($id)
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

    public function CalendarByKeeper($keeper)
    {
        try 
        {
            $query="SELECT * FROM ".$this->tableName." WHERE keeperid= :keeperid ;";
            $parameters["keeperid"]=$keeper->getKeeperId();

            $this->connection= Connection::GetInstance();
            $resultSet=$this->connection->Execute($query, $parameters);  
            
            $calendarByKeeperList=array();
            foreach($resultSet as $row)
            {
                $calendarDay=new Calendar();
                $calendarDay->setCalendarId("calendarid");
                $calendarDay->setDate("calendarDate");
                $calendarDay->setKeeper($keeper);
                $calendarDay->setStatus("status");

                array_push($calendarByKeeperList,$calendarDay);
            }
            return $calendarByKeeperList;

        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
?>
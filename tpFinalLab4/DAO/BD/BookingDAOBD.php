<?php
namespace DAO\BD;

use Models\Booking as Booking;
use DAO\BD\IBookingDAOBD as IBookingDAOBD;
use \Exception as Exception;
use DAO\BD\Connection as Connection;

class BookingDAOBD implements IBookingDAOBD
{
    private $connection;
    private $tableName = "booking";


    public function Add($booking)
    {
        try 
        {
            $query="INSERT INTO ".$this->tableName." (startDate,endDate,ownerid,keeperid) VALUES (:startDate,:endDate,:ownerid,:keeperid);";
            $parameters["startDate"]=$booking->getStartDate();
            $parameters["endDate"]=$booking->getEndDate();
            $parameters["ownerid"]=$booking->getOwner()->getOwnerId();
            $parameters["keeperid"]=$booking->getKeeper()->getKeeperId();

            $this->connection=Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query,$parameters);

        } catch (Exception $ex) {
            throw $ex;
        }

    }

    public function GetAll()
    {
        try 
        {
            $query="SELECT * FROM ".$this->tableName;

            $this->connection=Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            $bookingList=array();
            foreach ($resultSet as $row)
            {
                $keeperList = new KeeperDAOBD();
                $ownerList = new OwnerDAOBD();
                $booking=new Booking();
                $booking->setBookingNumber($row["bookingNr"]);
                $booking->setKeeper($keeperList->GetKeeperByKeeperId($row["keeperid"]));
                $booking->setOwner($ownerList->GetOwnerByOwnerId($row["ownerid"]));
                $booking->setStartDate($row["startDate"]);
                $booking->setEndDate($row["endDate"]);
                

                array_push($bookingList, $booking);
            }
            return $bookingList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
?>
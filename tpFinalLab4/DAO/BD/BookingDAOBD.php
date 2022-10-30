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
            $pet=$booking->getPet();
            $pet_id=$booking->getPet()->getIdPet();

            $query="INSERT INTO ".$this->tableName." (startDate,endDate,petid,keeperid,isConfirmed) VALUES (:startDate,:endDate,:petid,:keeperid, :isConfirmed);";
            $parameters["startDate"]=$booking->getStartDate();
            $parameters["endDate"]=$booking->getEndDate();
            $parameters["petid"]=$booking->getPet()->getIdPet();
            $parameters["keeperid"]=$booking->getKeeper()->getKeeperId();
            $parameters["isConfirmed"]=$booking->getIsConfirmed();

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
                $petList = new PetDAOBD();
                $booking=new Booking();
                $booking->setBookingNumber($row["bookingNr"]);
                $booking->setKeeper($keeperList->GetKeeperByKeeperId($row["keeperid"]));
                $booking->setPet($petList->GetPetByPetId($row["petid"]));
                $booking->setStartDate($row["startDate"]);
                $booking->setEndDate($row["endDate"]);
                $booking->setIsConfirmed($row["isConfirmed"]);
                

                array_push($bookingList, $booking);
            }
            return $bookingList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
?>
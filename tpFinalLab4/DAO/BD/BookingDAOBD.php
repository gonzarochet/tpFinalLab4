<?php
namespace DAO\BD;

use Models\Booking as Booking;
use DAO\BD\IBookingDAOBD as IBookingDAOBD;
use \Exception as Exception;
use DAO\BD\Connection as Connection;
use Models\Keeper as Keeper;
use Models\User as User;
use Models\Pet as Pet;
use Models\Owner as Owner;

class BookingDAOBD implements IBookingDAOBD
{
    private $connection;
    private $tableName = "booking";


    public function Add($booking)
    {
        try 
        {
            $query="INSERT INTO ".$this->tableName." (bookingDate,startDate,endDate,petid,keeperid,totalPrice, paidAmount,status) VALUES (:bookingDate,:startDate,:endDate,:petid,:keeperid,:totalPrice,:paidAmount, :status);";
            $parameters["bookingDate"]=$booking->getBookingDate();
            $parameters["startDate"]=$booking->getStartDate();
            $parameters["endDate"]=$booking->getEndDate();
            $parameters["petid"]=$booking->getPet()->getIdPet();
            $parameters["keeperid"]=$booking->getKeeper()->getKeeperId();
            $parameters["totalPrice"]=$booking->getTotalPrice();
            $parameters["paidAmount"]=$booking->getPaidAmount();
            $parameters["status"]=$booking->getStatus();

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
                $booking->setBookingDate($row["bookingDate"]);
                $booking->setKeeper($keeperList->GetKeeperByKeeperId($row["keeperid"]));
                $booking->setPet($petList->GetPetByPetId($row["petid"]));
                $booking->setStartDate($row["startDate"]);
                $booking->setEndDate($row["endDate"]);
                $booking->setTotalPrice($row["totalPrice"]);
                $booking->setPaidAmount($row["paidAmount"]);
                $booking->setStatus($row["status"]);
                

                array_push($bookingList, $booking);
            }
            return $bookingList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetKeeperBybookingNr($bookingNr){
        $bookingList = $this->GetAll();
        foreach ($bookingList as $booking)
        {
            if($bookingNr == $booking->getBookingNumber())
            {
                $keeper= $booking->getKeeper();
            }
        }
        return $keeper;
        
    }


    public function GetBookingBybookingNr($bookingNr)
    {
        $bookingList=$this->GetAll();
            
        foreach ($bookingList as $booking)
        {
            if($bookingNr == $booking->getBookingNumber())
            {
                $bookingFound=$booking;
            }
        }
        return $bookingFound;
    }

    public function AcceptBooking($bookingNr)
    {
        try {
            $query="UPDATE ".$this->tableName." SET status='Accepted' WHERE bookingNr= :bookingNr;";
            $parameters["bookingNr"]=$bookingNr;

            $this->connection=Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query,$parameters);

            
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function CancelBooking($bookingNr)
    {
        try{
            $query="UPDATE ".$this->tableName." SET status='Canceled' WHERE bookingNr= :bookingNr;";
            $parameters["bookingNr"]=$bookingNr;

            $this->connection=Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query,$parameters);
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function GetBookingsByOwnerId($ownerid){

        try{
            $query = "CALL GetBookingsByOwnerId( :ownerid);";
            $parameters["ownerid"]=$ownerid;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            $bookingList=array();
            foreach ($resultSet as $row)
            {
                $user= new User();
                $user->setId($row["userid"]);
                $user->setUsername($row["username"]);
                $user->setEmail($row["email"]);
                $user->setPassword($row["pass"]);
                $user->setFirstName($row["firstName"]);
                $user->setLastName($row["lastName"]);
                $user->setDateBirth($row["dateBirth"]);

                $keeper = new Keeper();
                $keeper->setKeeperId($row["keeperid"]);
                $keeper->setUser($user);
                $keeper->setReputation($row["reputation"]);
                $keeper->setFee($row["fee"]);
                $keeper->setSize($row["size"]);

                $userOwner = new User();
                $userOwner->setId($row["ouserid"]);
                $userOwner->setUsername($row["ousername"]);
                $userOwner->setEmail($row["oemail"]);
                $userOwner->setPassword($row["opass"]);
                $userOwner->setFirstName($row["ofirstName"]);
                $userOwner->setLastName($row["olastName"]);
                $userOwner->setDateBirth($row["odateBirth"]);

                $owner= new Owner();
                $owner->setOwnerId($row["ownerid"]);
                $owner->setUser($userOwner);

                $pet = new Pet();
                $pet->setIdPet($row["petid"]);
                $pet->setName($row["name"]);
                $pet->setBirthDate($row["birthDate"]);
                $pet->setOwner($owner);
                $pet->setVaccinationPlan($row["vaccinationPlan"]);
                $pet->setPicture($row["picture"]);
                $pet->setBreed($row["breed"]);
                $pet->setSize($row["size"]);
                $pet->setVideo($row["video"]);

                $booking=new Booking();
                $booking->setBookingNumber($row["bookingNr"]);
                $booking->setBookingDate($row["bookingDate"]);
                $booking->setKeeper($keeper);
                $booking->setPet($pet);
                $booking->setStartDate($row["startDate"]);
                $booking->setEndDate($row["endDate"]);
                $booking->setTotalPrice($row["totalPrice"]);
                $booking->setPaidAmount($row["paidAmount"]);
                $booking->setStatus($row["status"]);

                array_push($bookingList, $booking);
            }
            return $bookingList;
            


        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function SearchPetInFutureBookings($petid)
    {
        try{
            $query="SELECT * FROM ".$this->tableName." WHERE endDate >= curdate() and petid= :petid;";
            $parameters["petid"]=$petid;

            $this->connection=Connection::GetInstance();
            $resultSet=$this->connection->Execute($query,$parameters);

            $exists=false;
            if (count($resultSet)>0)
            {
                $exists=true;
            }
            return $exists;

        }catch(Exception $ex){
            throw $ex;
        }
        
    }

    public function ConfirmBooking($bookingNr)
    {
        try {
            $query = "UPDATE " . $this->tableName . " SET status='Confirmed' WHERE bookingNr= :bookingNr;";
            $parameters["bookingNr"] = $bookingNr;

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }    

}
?>
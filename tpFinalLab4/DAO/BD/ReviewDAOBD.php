<?php namespace DAO\BD;

use Models\Booking;
use Models\Keeper;
use Models\Owner;
use Models\Pet;
use Models\Review;
use DAO\BD\Connection as Connection;
use \Exception as Exception;
use Models\User;

class ReviewDAOBD implements IReviewDAOBD{


    private $connection;
    private $tableName = "review";
    private $ownerDAOBD;

    public function __construct(){
        $ownerDAOBD = new OwnerDAOBD();
    }
   

    public function Add(Review $review){

        try{
            $query = "CALL AddReview('".$review->getScore()."','".$review->getComment()."','".$review->getAsociatedBooking()."');";

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);

        }catch(Exception $ex){
            throw $ex;        
        }

    }


    public function GetReviewByKeeper($idKeeper)
    {
       try{

        $query = "CALL GetAllReviewByKeeperIdforOwner('".$idKeeper."');";

        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query);

        $reviewList = array();
        foreach ($resultSet as $row)
        {     

            $bookingNr = $row["bookingNr"];
            $username = $row["username"];
            $score = $row["score"];
            $comment = $row["comment"];
            $endDate = $row["endDate"];          
   
            array_push($reviewList, $bookingNr,$username,$score,$comment,$endDate);
        }



        return $reviewList;

     }catch(Exception $ex){
        throw $ex;
        }


    }

    public function GetReviewByKeeperIdforOwner($idKeeper)
    {
       try{

        $query = "CALL GetAllReviewByKeeperIdforOwner('".$idKeeper."');";

        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query);

        $reviewList = array();

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

            $owner= new Owner();
            $owner->setOwnerId($row["ownerid"]);
            $owner->setUser($user);

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
    

            $review = new Review();
            $review->setAsociatedBooking($booking);
            $review->setComment($row["comment"]);
            $review->setIdReview($row["reviewid"]);
            $review->setScore($row["score"]);

            array_push($reviewList, $review);
        }

        return $reviewList;

     }catch(Exception $ex){
        throw $ex;
        }
    }

    public function GetReviewByBooking($bookingNr)
    {
       try{

        $query = "CALL GetReviewByBooking('".$bookingNr."');";

        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query);

        $reviewList = array();
        foreach ($resultSet as $row)
        {     
            $bookingList = new BookingDAOBD();
            $review = new Review();
            $review->setIdReview($row["reviewid"]);
            $review->setScore($row["score"]);
            $review->setComment($row["comment"]);
            $review->setAsociatedBooking($bookingList->GetBookingBybookingNr($row["bookingNr"]));          
            
            array_push($reviewList, $review);
        }

        return $reviewList;

     }catch(Exception $ex){
        throw $ex;
        }


    }

    public function isReviewExist($bookingNr){

       try{
        $query = "CALL isReviewExist('".$bookingNr."');";
        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query);
        $flag = false;
        if (count($resultSet) > 0) {
            $resultValue = array_shift($resultSet[0]); 
            if ($resultValue == 1) {
                $flag = true;
            }
        }
        return $flag;

    }catch(Exception $ex){
        throw $ex;
    }


    }

}

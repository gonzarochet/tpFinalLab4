<?php namespace DAO\BD;

use Models\Review;
use DAO\BD\Connection as Connection;
use \Exception as Exception;

class ReviewDAOBD implements IReviewDAOBD{


    private $connection;
    private $tableName = "review";

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

        $query = "CALL GetReviewByKeeper('".$idKeeper."');";

        $this->connection = Connection::GetInstance();
        $resultSet = $this->connection->Execute($query);
        foreach ($resultSet as $row)
        {     
            $review = new Review();
            $review->setIdReview($row["reviewId"]);
            $review->setScore($row["score"]);
            $review->setComment($row["comment"]);
            $review->setAsociatedBooking($row["bookingNr"]);          
   
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

    public function isReviewExist($asociatedBooking){

       try{
        $query = "CALL isReviewExist('".$asociatedBooking."');";
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

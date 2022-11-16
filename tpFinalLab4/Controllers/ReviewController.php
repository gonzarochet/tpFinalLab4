<?php namespace Controllers;

use DAO\BD\ReviewDAO;
use DAO\BD\ReviewDAOBD;
use LDAP\Result;
use Models\Review;

class ReviewController{

    private $reviewDAO;

    public function __construct(){
        $this->reviewDAO = new ReviewDAOBD();
    }

    public function showReviewAddView($bookingNr){

        if($this->reviewDAO->isReviewExist($bookingNr)){
            $reviewList = $this->reviewDAO->GetReviewByBooking($bookingNr);
            require_once(VIEWS_PATH."show-review-view.php");
        }else{
            require_once(VIEWS_PATH."add-review-view.php");
        }
    }

    public function GenerateReview($score,$comment,$bookingNr){
        if(!$this->reviewDAO->isReviewExist($bookingNr)){
            $review = new Review ();
            $review->setScore($score);
            $review->setComment($comment);
            $review->setAsociatedBooking($bookingNr);
            $this->reviewDAO->Add($review);
            
            $reviewList = $this->reviewDAO->GetReviewByBooking($bookingNr);
            require_once(VIEWS_PATH."show-review-view.php");
            
        }
    }


    public function ShowListReviewByKeeper()    
    {
        $reviewList=array();
        $keeper=$_SESSION["keeperOwner"];
    
        $reviewListAll=$this->reviewDAO->GetReviewByKeeper($keeper->getKeeperid());

        foreach($reviewListAll as $review)
        {
            if($review->getBooking()->getKeeper() == $keeper)
            {
                array_push($reviewList,$review);
            }
        }
        require_once(VIEWS_PATH."show-review-view.php");
    }

    public function ShowListReviewByBooking($asociatedBooking)    
    {
        
        $reviewListAll=$this->reviewDAO->GetReviewByBooking($asociatedBooking);

        $reviewList = array();

        foreach($reviewListAll as $review)
        {
            if($review->getBooking()->getBookingId() == $asociatedBooking)
            {
                array_push($reviewList,$review);
            }
        }
        require_once(VIEWS_PATH."show-review-view.php");
    }




    
}



?>
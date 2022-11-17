<?php namespace Controllers;

use DAO\BD\BookingDAOBD;
use DAO\BD\KeeperDAOBD;
use DAO\BD\ReviewDAO;
use DAO\BD\ReviewDAOBD;
use DAO\JSON\KeeperDAO;
use LDAP\Result;
use Models\Keeper;
use Models\Review;
use Services\SessionsHelper;

class ReviewController{

    private $reviewDAO;
    private $bookingDAO;

    private $keeperDAO;

    public function __construct(){
        $this->reviewDAO = new ReviewDAOBD();
        $this->bookingDAO = new BookingDAOBD();
        $this->keeperDAO = new KeeperDAOBD();
    }

    public function showReviewAddView($bookingNr){
        SessionsHelper::validateSession();

        if($this->reviewDAO->isReviewExist($bookingNr)){
            $reviewList = $this->reviewDAO->GetReviewByBooking($bookingNr);
            require_once(VIEWS_PATH."show-review-view.php");
        }else{
            require_once(VIEWS_PATH."add-review-view.php");
        }
    }

    public function GenerateReview($score,$comment,$bookingNr){
        SessionsHelper::validateSession();
        if(!$this->reviewDAO->isReviewExist($bookingNr)){
            $review = new Review ();
            $review->setScore($score);
            $review->setComment($comment);
            $review->setAsociatedBooking($bookingNr);
            $this->reviewDAO->Add($review);

            $keeper = $this->bookingDAO->GetKeeperBybookingNr($bookingNr);

            $this->keeperDAO->updateReputation($keeper);
            
            $reviewList = $this->reviewDAO->GetReviewByBooking($bookingNr);
            require_once(VIEWS_PATH."show-review-view.php");
            
        }
    }


    public function ShowListReviewByKeeper()    
    {
        SessionsHelper::validateSession();
        $reviewList=array();
        $keeper=SessionsHelper::getKeeperSession();
    
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
        SessionsHelper::validateSession();
        
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
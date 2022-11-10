<?php namespace DAO\BD;

use Models\Review;

interface IReviewDAOBD{

    function Add(Review $review);
    function GetReviewByKeeper($idKeeper);
    function isReviewExist($asociatedBooking);

}


?>
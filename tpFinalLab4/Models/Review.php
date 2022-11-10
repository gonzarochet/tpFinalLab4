<?php namespace Models;

class Review{

    private $idReview;
    private $score;
    private $comment;
    private $asociatedBooking;

    public function __construct($idReview = "",$score="",$comment = "",$asociatedBooking="")
    {
        $this->idReview = $idReview;
        $this->score = $score;
        $this->comment = $comment;
        $this->asociatedBooking = $asociatedBooking;
    }


    /**
     * Get the value of idReview
     */
    public function getIdReview()
    {
        return $this->idReview;
    }

    /**
     * Set the value of idReview
     */
    public function setIdReview($idReview): self
    {
        $this->idReview = $idReview;

        return $this;
    }

    /**
     * Get the value of score
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set the value of score
     */
    public function setScore($score): self
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get the value of comment
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     */
    public function setComment($comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of asociatedBooking
     */
    public function getAsociatedBooking()
    {
        return $this->asociatedBooking;
    }

    /**
     * Set the value of asociatedBooking
     */
    public function setAsociatedBooking($asociatedBooking): self
    {
        $this->asociatedBooking = $asociatedBooking;

        return $this;
    }

    }

?>
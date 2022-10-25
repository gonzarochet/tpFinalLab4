<?php namespace Models;

use Models\User as User;

class Keeper{

    private $idKeeper;
    private $user; // the same as the user id. 
    private $reputation;


    /*
    public function __construct($id = null, $username = null, $email = null, $password=null, $firstName = null, $lastname = null, $dateBirth = null,$reputation = null){
        parent::__construct($id,$username,$email,$password,$firstName,$lastname,$dateBirth);
        $this->id = $id;
        $this->reputation = $reputation;
    }
    */

    /**
     * Get the value of id
     */
    public function getKeeperId()
    {
        return $this->idKeeper;
    }

    /**
     * Set the value of id
     */
    public function setKeeperId($idKeeper): self
    {
        $this->idKeeper = $idKeeper;
        return $this;
    }

    /**
     * Get the value of reputation
     */
    public function getReputation()
    {
        return $this->reputation;
    }

    /**
     * Set the value of reputation
     */
    public function setReputation($reputation): self
    {
        $this->reputation = $reputation;

        return $this;
    }


    public function setUser(User $user){
        $this->user = $user;
    }

    public function getUser(){
        return $this->user;
    }
}


?>
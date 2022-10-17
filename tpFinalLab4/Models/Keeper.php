<?php namespace Models;

use Models\User as User;

class Keeper extends User{

    private $id; // the same as the user id. 
    private $reputation;



    public function __construct($id = null, $username = null, $email = null, $password=null, $firstName = null, $lastname = null, $dateBirth = null,$reputation = null){
        parent::__construct($id,$username,$email,$password,$firstName,$lastname,$dateBirth);
        $this->id = $id;
        $this->reputation = $reputation;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

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
}


?>
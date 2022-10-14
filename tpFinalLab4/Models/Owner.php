<?php namespace Models;

use Models\Person as Person;

class Owner extends Person{

    private $username;

    public function __construct($dni, $id, $firstName, $lastName, $age, $username){
        parent::__construct($dni,$id,$firstName,$lastName,$age);
        $this->username = $username;
    }


    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     */
    public function setUsername($username): self
    {
        $this->username = $username;

        return $this;
    }
}

?>
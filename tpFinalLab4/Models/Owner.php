<?php namespace Models;


class Owner{


    
    private $ownerId;
    private $user;
   // private $petsList;

    /*
    public function __construct();
        $this->id = $id;
        $this->petsList = $petsList;
    }*/



    /**
     * Get the value of id
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }

    /**
     * Set the value of id
     */
    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the User
     */
    public function setUser(User $user)
    {
        $this->user=$user ;
    }
}

?>
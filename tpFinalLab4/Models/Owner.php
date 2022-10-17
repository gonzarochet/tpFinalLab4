<?php namespace Models;

use Models\User as User;

class Owner extends User{


    
    private $id; //the same as the User id. 
    private $petsList;

    public function __construct($id=null, $username=null,$email=null,$password=null, $firstName=null, $lastName=null,$dateBirth=null,$petsList=null){
        parent::__construct($id,$username,$email,$password,$firstName,$lastName,$dateBirth);
        $this->id = $id;
        $this->petsList = $petsList;
    
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
     * Get the value of petsList
     */
    public function getPetsList()
    {
        return $this->petsList;
    }

    /**
     * Set the value of petsList
     */
    public function setPetsList($petsList): self
    {
        $this->petsList = $petsList;

        return $this;
    }
}

?>
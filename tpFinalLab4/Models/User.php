<?php namespace Models;

class User{

    private $id;
    private $username;
    private $email;
    private $password;
    private $firstName;
    private $lastName;
    private $dateBirth;

    public function __construct($id=null,$username=null, $email=null, $password=null ,$firstName=null,$lastName=null,$dateBirth=null){
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dateBirth = $dateBirth;
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

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($newUsername){
        $this->username = $newUsername;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($newEmail){
        $this->email = $newEmail;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($newPassword){
        $this->password = $newPassword;
    }


    /**
     * Get the value of nombre
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of nombre
     */
    public function setFirstName($firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of apellido
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of apellido
     */
    public function setLastName($lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of edad
     */
    public function getDateBirth()
    {
        return $this->dateBirth;
    }

    /**
     * Set the value of edad
     */
    public function setDateBirth($dateBirth): self
    {
        $this->dateBirth = $dateBirth;

        return $this;
    }

    public function getAge(){
        $today = date("Y-m-d");
        $diff = date_diff(date_create($this->getDateBirth()), date_create($today));
        return $diff->format('%y');
    }
} 

?>
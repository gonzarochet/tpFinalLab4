<?php namespace Models;

abstract class Person{

    private $dni;
    private $id;
    private $firstName;
    private $lastName;
    private $age;

    public function __construct($dni,$id,$firstName,$lastName,$age){
        $this->dni = $dni;
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
    }


    /**
     * Get the value of dni
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set the value of dni
     */
    public function setDni($dni): self
    {
        $this->dni = $dni;

        return $this;
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
        $this->lastname = $lastName;

        return $this;
    }

    /**
     * Get the value of edad
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set the value of edad
     */
    public function setAge($age): self
    {
        $this->age = $age;

        return $this;
    }
} 

?>
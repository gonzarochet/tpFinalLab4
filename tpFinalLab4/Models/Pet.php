<?php
namespace Models;

class Pet
{
    private $idPet;
    private $name;
    private $birthDate;
    private $owner;
    private $vaccinationPlan;
    private $picture;
    private $breed;
    private $video;

    public function getIdPet(){
        return $this->idPet;
    }
    public function setIdPet($idPet){
        $this->idPet=$idPet;
    }
    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name=$name;
    }
    public function getBirthDate(){
        return $this->birthDate;
    }
    public function setBirthDate($birthDate){
        $this->birthDate=$birthDate;
    }
    public function getOwner(){
        return $this->owner;
    }
    public function setOwner(Owner $owner){
        $this->owner=$owner;
    }
    public function getVaccinationPlan(){
        return $this->vaccinationPlan;
    }
    public function setVaccinationPlan($vaccinationPlan){
        $this->vaccinationPlan=$vaccinationPlan;
    }
    public function getPicture(){
        return $this->picture;
    }
    public function setPicture($picture){
        $this->picture=$picture;
    }
    public function getBreed(){
        return $this->breed;
    }
    public function setBreed($breed){
        $this->breed=$breed;
    }
    public function getVideo(){
        return $this->video;
    }
    public function setVideo($video){
        $this->video=$video;
    }

}

?>
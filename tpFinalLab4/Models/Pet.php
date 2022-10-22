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
    private $size;
    private $video;
    private $comments;

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
    public function getAge(){
        $today = date("Y-m-d");
        $diff = date_diff(date_create($this->getBirthDate()), date_create($today));
        return $diff->format('%y');
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
    public function getSize(){
        return $this->size;
    }
    public function setSize($size)
    {
        $this->size=$size;
    }
    public function getVideo(){
        return $this->video;
    }
    public function setVideo($video){
        $this->video=$video;
    }
    public function getComments(){
        return $this->comments;
    }
    public function setComments($comments){
        $this->comments=$comments;
    }

}

?>
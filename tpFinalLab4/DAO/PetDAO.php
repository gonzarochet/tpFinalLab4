<?php namespace DAO;

    use Models\Pet as Pet;
    use DAO\IPetDAO as IPetDAO;

    use Controllers\PetController as PetController;

    class PetDAO implements IPetDAO{

        private $petList = array();

        public function Add(Pet $pet){
            $this->RetrieveData();
            $pet->setIdPet($this->GetNextId());     
            
            array_push($this->petList,$pet);
            
            $this->SaveData();
        }
        
        public function GetAll(){
            $this->RetrieveData();
            return $this->petList;
        }

        private function SaveData(){

            $arraytoEncode = array();

            foreach($this->petList as $pet){
                $valuesArray["idPet"] = $pet->getIdPet();
                $valuesArray["name"] = $pet->getName();
                $valuesArray["owner"]= $pet->getOwner()->getId();
                $valuesArray["vaccinationPlan"]=$pet->getVaccinationPlan();
                $valuesArray["birthDate"]= $pet->getBirthDate();
                $valuesArray["picture"]= $pet->getPicture();
                $valuesArray["breed"]=$pet->getBreed();
                //$valuesArray["video"]=$pet->getVideo();

                array_push($arraytoEncode,$valuesArray);

            }
            $jsonContent = json_encode($arraytoEncode, JSON_PRETTY_PRINT);

            file_put_contents('Data/pets.json',$jsonContent);

        }

        private function RetrieveData(){

            $this->petList = array();

            if(file_exists('Data/pets.json')){
                $jsonContent = file_get_contents('Data/pets.json');
                
                $arraytoDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();

                foreach($arraytoDecode as $valuesArray){
                    $pet = new Pet();
                    
                    $pet->setIdPet($valuesArray["idPet"]);
                    $pet->setName($valuesArray["name"]);
                    //$pet->setOwner($valuesArray["owner"]);
                    $pet->setVaccinationPlan($valuesArray["vaccinationPlan"]);
                    $pet->setBirthDate($valuesArray["birthDate"]);
                    $pet->setPicture($valuesArray["picture"]);
                    $pet->setBreed($valuesArray["breed"]);
                    //$pet->setVideo($valuesArray["video"]);
                    
                    array_push($this->petList,$pet);
                }
            }

        }
        private function GetNextId()
        {
            $id = 0;
            foreach($this->petList as $pet)
            {
                $id = ($pet->getIdPet() > $id) ? $pet->getIdPet() : $id;
            }
            return $id + 1;
        }

    }

?>
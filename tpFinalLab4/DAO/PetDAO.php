<?php namespace DAO;

    use Models\Pet as Pet;
    use DAO\IPetDAO as IPetDAO;
    use Models\Owner as Owner;
    use DAO\OwnerDAO as OwnerDAO;

    use Controllers\PetController as PetController;

    class PetDAO implements IPetDAO{

        private $petList;
        private $ownerList;

        public function __construct()
        {
        $this->petList = array();
        $this->ownerList = new ownerDAO();   //por qué lo tengo que inicializar en el constructor y no lo puedo llamar en la fx dps?
        }

        public function Add(Pet $pet){
            $this->RetrieveData(); 
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
                $valuesArray["ownerId"]= $pet->getOwner()->getOwnerId();
                $valuesArray["vaccinationPlan"]=$pet->getVaccinationPlan();
                $valuesArray["birthDate"]= $pet->getBirthDate();
                $valuesArray["picture"]= $pet->getPicture();
                $valuesArray["breed"]=$pet->getBreed();
                $valuesArray["video"]=$pet->getVideo();
                $valuesArray["size"]=$pet->getSize();
                $valuesArray["comments"]=$pet->getComments();

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
                    
                    //Busco el objeto owner en el DAO por ownerId
                    $owner = new Owner();                    
                    $owner = $this->ownerList->GetOwnerByOwnerId($valuesArray["ownerId"]);
                    
                    //Creo objeto Pet
                    $pet = new Pet();
                    $pet->setIdPet($valuesArray["idPet"]);
                    $pet->setName($valuesArray["name"]);
                    $pet->setOwner($owner);                                 //Inserto objeto owner
                    $pet->setVaccinationPlan($valuesArray["vaccinationPlan"]);
                    $pet->setBirthDate($valuesArray["birthDate"]);
                    $pet->setPicture($valuesArray["picture"]);
                    $pet->setBreed($valuesArray["breed"]);
                    $pet->setVideo($valuesArray["video"]);
                    $pet->setSize($valuesArray["size"]);
                    $pet->setComments($valuesArray["comments"]);
                    
                    array_push($this->petList,$pet);
                }
            }

        }
        public function GetNextPetId()
        {
            $id = 0;
            $this->RetrieveData();
            foreach($this->petList as $pet)
            {
                $idPet=$pet->getIdPet();
                
                $id = ($pet->getIdPet() > $id) ? $pet->getIdPet() : $id;
            }
            return $id + 1;
        }

        public function Remove($id)
        {            
            $this->RetrieveData();
            
            $this->petList = array_filter($this->petList, function($pet) use($id){                
                return $pet->getIdPet() != $id;
            });
            
            $this->SaveData();
        }

    }

?>
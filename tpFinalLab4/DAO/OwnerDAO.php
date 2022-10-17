<?php namespace DAO;

    use Models\Owner as Owner;
    use Controllers\OwnerController as OwnerController;

    class OwnerDAO implements IOwnerDAO{

        private $ownerList = array();

        public function Add(Owner $owner){
            $this->RetrieveData();
            array_push($this->ownerList,$owner);
            $this->SaveData();

        }

        public function GetAll(){
            $this->RetrieveData();
            return $this->ownerList;
        }

        private function SaveData(){

            $arraytoEncode = array();

            foreach($this->ownerList as $owner){
                $valuesArray["id"] = $owner->getId();
                $valuesArray["username"] = $owner->getUsername();
                $valuesArray["email"]= $owner->getEmail();
                $valuesArray["password"]=$owner->getPassword();
                $valuesArray["firstName"] = $owner->getFirstName();
                $valuesArray["lastName"] = $owner->getLastName();
                $valuesArray["dateBirth"] = $owner->getDateBirth();
                $valuesArray["petsList"] = $owner->getPetsList();

                array_push($arraytoEncode,$valuesArray);

            }
            $jsonContent = json_encode($arraytoEncode, JSON_PRETTY_PRINT);

            file_put_contents('Data/owners.json',$jsonContent);

        }

        private function RetrieveData(){

            $this->ownerList = array();

            if(file_exists('Data/owners.json')){
                $jsonContent = file_get_contents('Data/owners.json');
                
                $arraytoDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();

                foreach($arraytoDecode as $valuesArray){
                    $owner = new Owner($valuesArray["id"],$valuesArray["username"], $valuesArray["email"],$valuesArray["password"],$valuesArray["firstName"],
                    $valuesArray["lastName"],$valuesArray["dateBirth"],$valuesArray["petsList"]);
                    /*
                    $owner->setId($valuesArray["id"]);
                    $owner->setDni($valuesArray["dni"]);
                    $owner->setFirstName($valuesArray["firstName"]);
                    $owner->setLastName($valuesArray["lastName"]);
                    $owner->setAge($valuesArray["age"]);
                    $owner->serUsername($valuesArray["username"]);
                    */
                    array_push($this->ownerList,$owner);
                }
            }

        }

    }
        



?>
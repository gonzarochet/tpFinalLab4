<?php namespace DAO;

    use Models\Owner as Owner;
    //prueba
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
                $valuesArray["dni"] = $owner->getDni();
                $valuesArray["id"] = $owner->getId();
                $valuesArray["firstName"] = $owner->getFirstName();
                $valuesArray["lastName"] = $owner->getLastName();
                $valuesArray["age"] = $owner->getAge();
                $valuesArray["username"] = $owner->getUsername();

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
                    $owner = new Owner($valuesArray["dni"],$valuesArray["id"], $valuesArray["firstName"],
                    $valuesArray["lastName"],$valuesArray["age"],$valuesArray["username"]);
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
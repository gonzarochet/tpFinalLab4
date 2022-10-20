<?php namespace DAO;

    use Models\User as User;
    use Models\Owner as Owner;
    use DAO\IOwnerDAO as IOwnerDAO;
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
                
                $valuesArray["ownerId"] = $owner->getOwnerId();
                
                var_dump($owner->getUser());
                //To pull user values
                $valuesArrayUser["userId"]=$owner->getUser()->getId();
                $valuesArrayUser["username"]=$owner->getUser()->getUsername();
                $valuesArrayUser["email"]=$owner->getUser()->getEmail();
                $valuesArrayUser["password"]=$owner->getUser()->getPassword();
                $valuesArrayUser["firstName"]=$owner->getUser()->getFirstName();
                $valuesArrayUser["lastName"]=$owner->getUser()->getLastName();
                $valuesArrayUser["dateBirth"]=$owner->getUser()->getDateBirth();

                //Inserts User Array in the owner Array
                $valuesArray["user"]=$valuesArrayUser;

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
                    var_dump($valuesArray);
                    
                    $owner = new Owner();
                    foreach($valuesArray["user"] as $user){
                        $userInsert = new User($user["id"],$user["username"],$user["email"],$user["password"],$user["firstName"],$user["lastName"],$user["dateBirth"]);
                        $owner->setOwnerId($userInsert->getId());
                        $owner->setUser($userInsert);
                    }
                    array_push($this->ownerList,$owner);
                    
                }
            }

        }

    }
        



?>
<?php namespace DAO;

    use Models\User as User;
    use Models\Owner as Owner;
    use DAO\IOwnerDAO as IOwnerDAO;
    //use Controllers\OwnerController as OwnerController;

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
                    
                    //Create a new array for user data
                    $userArray= array();                
                    $userArray= $valuesArray["user"];
                    //new user object
                    $user = new User(); 
                    $user->setId($userArray["userId"]);
                    $user->setUsername($userArray["username"]);
                    $user->setEmail($userArray["email"]);
                    $user->setPassword($userArray["password"]);
                    $user->setFirstName($userArray["firstName"]);
                    $user->setLastName($userArray["lastName"]);
                    $user->setDateBirth($userArray["dateBirth"]);

                    $owner = new Owner();
                    $owner->setOwnerId($valuesArray["ownerId"]);
                    $owner->setUser($user); //inserts the new user object                                     
                    
                    array_push($this->ownerList,$owner);
                    
                }
            }

        }

        public function UserExistsInOwners($user)
        {
            $userId = $user->getId();
            
            $this->RetrieveData(); 
            $exists=false;
            foreach($this->ownerList as $owner){

                //I search in each user of the owners list
                $user=$owner->getUser();
                if ($user->getId() ==$userId)
                {
                    $exists=true;
                }
            }
            return $exists;
        }

        public function GetNextOwnerId()
        {
            $id = 0;
            foreach($this->ownerList as $owner)
            {
                $id = ($owner->getOwnerId() > $id) ? $owner->getOwnerId() : $id;
            }
            return $id + 1;
        }
        
    }


?>
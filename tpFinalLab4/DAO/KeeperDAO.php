<?php namespace DAO;

use Models\Keeper as Keeper;
use MODELS\User as User;

class KeeperDAO implements IKeeperDAO{

    private $keeperList = array();

    public function Add(Keeper $keeper){
        $this->RetrieveData();
        array_push($this->keeperList,$keeper);
        $this->SaveData();
    }

    public function getAll(){
        $this->RetrieveData();
        return $this->keeperList;


    }

    private function SaveData(){

        $arraytoEncode = array();

        foreach($this->keeperList as $keeper){

            $valuesArray["keeperId"] = $keeper->getKeeperId();
            $valuesArray["reputation"] = $keeper->getReputation();


            $valuesArrayUser["userId"] = $keeper->getUser()->getId();
            $valuesArrayUser["username"] = $keeper->getUser()->getUsername();
            $valuesArrayUser["email"]= $keeper->getUser()->getEmail();
            $valuesArrayUser["password"]= $keeper->getUser()->getPassword();
            $valuesArrayUser["firstName"]= $keeper->getUser()->getFirstName();
            $valuesArrayUser["lastName"] = $keeper->getUser()->getLastName();
            $valuesArrayUser["dateBirth"] = $keeper->getUser()->getDateBirth();
            

            $valuesArray["user"] = $valuesArrayUser;
            

            array_push($arraytoEncode,$valuesArray);

        }
        $jsonContent = json_encode($arraytoEncode, JSON_PRETTY_PRINT);

        file_put_contents('Data/keepers.json',$jsonContent);

    }

    private function RetrieveData(){
        $this->keeperList = array();

        if(file_exists('Data/keepers.json')){
            $jsonContent = file_get_contents('Data/keepers.json');
            
            $arraytoDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();
            
            foreach($arraytoDecode as $valuesArray){
                $userArray = array();
                $userArray = $valuesArray["user"];
                
                $user = new User();
                $user->setId($userArray["userId"]);
                $user->setUsername($userArray["username"]);
                $user->setEmail($userArray["email"]);
                $user->setPassword($userArray["password"]);
                $user->setFirstName($userArray["firstName"]);
                $user->setLastName($userArray["lastName"]);
                $user->setDateBirth($userArray["dateBirth"]);

                $keeper = new Keeper();
                $keeper->setKeeperId($valuesArray["keeperId"]);
                $keeper->setUser($user);
                $keeper->setReputation($valuesArray["reputation"]);

                array_push($this->keeperList,$keeper);
                
            }

        }
    }

    public function UserExistsInKeepers($user){
        $flag = false;

        $userId = $user->getId();

        $this->RetrieveData();

        foreach($this->keeperList as $keeper){
            $user = $keeper->getUser();

            if($user->getId() == $userId){
                $flag = true;
            }
        }
    
        return $flag;
    }

    public function GetNextKeeperId()
    {
        $id = 0;
        foreach($this->keeperList as $keeper)
        {
            $id = ($keeper->getKeeperId() > $id) ? $keeper->getKeeperId() : $id;
        }
        return $id + 1;
    }

    public function GetKeeperByUserId($userId)
        {
            $keeperFound = new Keeper();

            $this->RetrieveData();
            
            foreach ($this->keeperList as $keeper){

                $user=$keeper->getUser();
                {                    
                    if($user->getid()==$userId)
                    {
                        $keeperFound=$keeper;
                    }
                }
            }
            return $keeperFound;
        }

        public function GetKeeperByKeeperId($keeperId)
        {
            $keeperFound = new Keeper();

            $this->RetrieveData();
            
            foreach ($this->keeperList as $keeper)
            {
                if ($keeper->getKeeperId()==$keeperId)
                {
                        $keeperFound=$keeper;
                }
                
            }
            return $keeperFound;
        }





}





?>
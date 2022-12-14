<?php namespace DAO\JSON;

Use Models\User as User;
use DAO\JSON\IUserDAO as IUserDAO;

class UserDAO implements IUserDAO{

    private $userList=array();

    public function Add(User $user){
        
        $this->RetrieveData();
        $user->setId($this->GetNextUserId());
        array_push($this->userList,$user);
        $this->SaveData();
        
    }

    public function GetAll(){
        $this->RetrieveData();
        return $this->userList;
    }

    private function SaveData(){

        $arraytoEncode = array();

        foreach($this->userList as $user){
            $valuesArray["id"] = $user->getId();
            $valuesArray["username"] = $user->getUsername();
            $valuesArray["email"]= $user->getEmail();
            $valuesArray["password"]=$user->getPassword();
            $valuesArray["firstName"] = $user->getFirstName();
            $valuesArray["lastName"] = $user->getLastName();
            $valuesArray["dateBirth"] = $user->getDateBirth();

            array_push($arraytoEncode,$valuesArray);

        }
        $jsonContent = json_encode($arraytoEncode, JSON_PRETTY_PRINT);

        file_put_contents('Data/users.json',$jsonContent);

    }

    private function RetrieveData(){

        $this->userList = array();

        if(file_exists('Data/users.json')){
            $jsonContent = file_get_contents('Data/users.json');
            
            $arraytoDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();

            foreach($arraytoDecode as $valuesArray){
                //$user = new User($valuesArray["id"],$valuesArray["username"], $valuesArray["email"],$valuesArray["password"],$valuesArray["firstName"],$valuesArray["lastName"],$valuesArray["dateBirth"]);
                
                $user = new User(); 
                $user->setId($valuesArray["id"]);
                $user->setUsername($valuesArray["username"]);
                $user->setEmail($valuesArray["email"]);
                $user->setPassword($valuesArray["password"]);
                $user->setFirstName($valuesArray["firstName"]);
                $user->setLastName($valuesArray["lastName"]);
                $user->setDateBirth($valuesArray["dateBirth"]);
                
                array_push($this->userList,$user);
            }
           
        }

    }

    public function GetNextUserId()
        {
            $id = 0;
            foreach($this->userList as $user)
            {
                $id = ($user->getId() > $id) ? $user->getId() : $id;
            }
            return $id + 1;
        }

    /*public function getLastId(){
        $this->userList = array();
        $id = 0;

        if(file_exists('Data/users.json')){
            $jsonContent = file_get_contents('Data/users.json');
            
            $arraytoDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();

            $lastIndex = count($arraytoDecode);
            if($lastIndex>0){
                $id = $arraytoDecode[$lastIndex-1]["id"];
            }
        }
        return $id;
    }*/

    public function GetUserByEmail($email)
        {
            $user = null;

            $this->RetrieveData();

            $users = array_filter($this->userList, function($user) use($email){
                return $user->getEmail() == $email;
            });

            $users = array_values($users); 

            return (count($users) > 0) ? $users[0] : null;
        }
    
        public function isEmailExists($email){
            $flag = false;

            $this->RetrieveData();
            
            foreach($this->userList as $user){
                if($user->getEmail()==$email){
                    $flag = true;
                }
            }
            return $flag;

        }
        public function isUsernameExists($username){
            $flag = false;

            $this->RetrieveData();
            
            foreach($this->userList as $user){
                if($user->getUsername()==$username){
                    $flag = true;
                }
            }
            return $flag;

        }

        public function isUserNameOrEmailExists($username, $email)
        {
            $flag=false;
            if ($this->isUsernameExists($username)==true or $this->isEmailExists($email))
            {
               $flag=true;
            }
            return $flag;
        }
}
?> 
<?php namespace DAO;

use Models\Keeper as Keeper;
use MODELS\User as User;

class KeeperDAO implements IUserDAO{

    private $keeperList;

    public function Add(User $user){}

    public function getAll(){}

    private function SaveData(){

        $arraytoEncode = array();

        foreach($this->keeperList as $keeper){
            $valuesArray["id"] = $keeper->getId();
            $valuesArray["username"] = $keeper->getUsername();
            $valuesArray["email"]= $keeper->getEmail();
            $valuesArray["password"]=$keeper->getPassword();
            $valuesArray["firstName"] = $keeper->getFirstName();
            $valuesArray["lastName"] = $keeper->getLastName();
            $valuesArray["dateBirth"] = $keeper->getDateBirth();
            $valuesArray["reputation"] = $keeper->getReputation();
            

            array_push($arraytoEncode,$valuesArray);

        }
        $jsonContent = json_encode($arraytoEncode, JSON_PRETTY_PRINT);

        file_put_contents('Data/keepers.json',$jsonContent);

    }





}





?>
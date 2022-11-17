<?php

namespace DAO\BD;

use Models\Keeper as Keeper;
use DAO\BD\IKeeperDAOBD as IKeeperDAOBD;
use \Exception as Exception;
use DAO\BD\Connection as Connection;
use DAO\BD\UserDAOBD as UserDAOBD;
use Models\User as User;

class KeeperDAOBD implements IKeeperDAOBD
{
    private $connection;
    private $tableName="keeper";

    public function Add(Keeper $keeper)
    {
        try
        {
            $query="INSERT INTO ".$this->tableName." (keeperid, userid, reputation, fee, size) VALUES (:keeperid,:userid,:reputation, :fee, :size);";
            
            $parameters["keeperid"]=$keeper->getKeeperId();
            $parameters["userid"]=$keeper->getUser()->getId();            
            $parameters["reputation"]=$keeper->getReputation();
            $parameters["fee"]=$keeper->getFee();
            $parameters["size"]=$keeper->getSize();

            $this->connection=Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }

    }

    public function GetAll()
    {
        try
        {
            $keeperList=array();
            $query="SELECT * FROM ".$this->tableName.";";

            $this->connection=Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            foreach($resultSet as $row)
            {
                $userList = new UserDAOBD();
                $user = new User();
                $user=$userList->GetUserByUserId($row["userid"]);

                $keeper=new Keeper();
                $keeper->setKeeperId($row["keeperid"]);
                $keeper->setUser($user);
                $keeper->setReputation($row["reputation"]);
                $keeper->setFee($row["fee"]);
                $keeper->setSize($row["size"]);

                array_push($keeperList,$keeper);

            }
            return $keeperList;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function UserExistsInKeepers($user)
    {
        try
        {
            $query="SELECT count(*) as cantidad FROM ".$this->tableName." WHERE userid= :userid ;";
            $parameters["userid"]=$user->getId();

            $this->Connection = Connection::GetInstance();

            $resultSet = $this->Connection->Execute($query,$parameters);

            $flag=false;
            if (count($resultSet) > 0)
            {
                $resultFirstRow=$resultSet[0];
                $cant = $resultFirstRow["cantidad"];
                if ($cant==1)
                {
                    $flag=true;
                }
            }   
            return $flag;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }           
    }

    public function GetKeeperByUserId($userId)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (userid = :userid)";

                $parameters["userid"] =  $userId;
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query,$parameters);
                
                $keeper = new Keeper();
                if (count($resultSet)>0)
                {
                    $resultFirstRow = $resultSet[0];

                    $userList = new UserDAOBD();
                    $user = new User();
                    $user=$userList->GetUserByUserId($resultFirstRow["userid"]);

                    $keeper->setKeeperId($resultFirstRow["keeperid"]);
                    $keeper->setUser($user);
                    $keeper->setReputation($resultFirstRow["reputation"]);
                    $keeper->setFee($resultFirstRow["fee"]);
                    $keeper->setSize($resultFirstRow["size"]);
                }
                return $keeper;
            }
            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetKeeperByKeeperId($keeperId)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (keeperid = :keeperid)";

                $parameters["keeperid"] =  $keeperId;
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query,$parameters);
                
                $keeper = new Keeper();
                if (count($resultSet)>0)
                {
                    $resultFirstRow = $resultSet[0];

                    $userList = new UserDAOBD();
                    $user = new User();
                    $user=$userList->GetUserByUserId($resultFirstRow["userid"]);

                    $keeper->setKeeperId($resultFirstRow["keeperid"]);
                    $keeper->setUser($user);
                    $keeper->setReputation($resultFirstRow["reputation"]);
                    $keeper->setSize($resultFirstRow["size"]);
                    $keeper->setFee($resultFirstRow["fee"]);
                }
                return $keeper;
            }
            catch (Exception $ex)
            {
                throw $ex;
            }
        }


        public function updateKeeper($keeperid, $fee,$size){
            try{
                $query = "CALL updateKeeper('".$keeperid."','".$fee."','".$size."');";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);

            }catch(Exception $ex){
                throw $ex;
            }

        }

        public function updateReputation($keeper){
            try{
                $query = "CALL GetAllReviewByKeeperId('".$keeper->getKeeperId()."');";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                $reputation = 0.0;
                $i = 0;

                foreach($resultSet as $row)
                {
                    $reputation = $row["score"];
                    $i++;
                }

                $queryReputation = "CALL updateReputation('".$keeper->getKeeperId()."','".$reputation."');";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($queryReputation);

        }catch(Exception $ex){
            throw $ex;
        }
    }
}
?>
<?php namespace DAO\BD;

    use \Exception as Exception;
    use Models\User as User;
    use Models\Owner as Owner;
    use DAO\BD\UserDAOBD as UserDAOBD;
    use DAO\BD\IOwnerDAOBD as IOwnerDAOBD;
    use DAO\BD\Connection as Connection;
    //use Controllers\OwnerController as OwnerController;

    class OwnerDAOBD implements IOwnerDAOBD{
        private $connection;
        private $tableName="owner";
        private $userList;

        public function Add(Owner $owner)
        {
            try {

                $query="INSERT INTO ".$this->tableName." (userid) VALUES (:userid);";
    
                $parameters["userid"]=$owner->getUser()->getId();
    
                $this->connection=Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
    
            } catch (Exception $ex) {
                throw $ex;
            }
        }

        public function GetAll(){
            try
                {
                    $ownerList = array();

                    $query = "CALL GetAllOwners()";
    
                    //$query = "SELECT * FROM ".$this->tableName." O INNER JOIN USER U ON O.USERID=U.USERID;" ;
    
                    $this->connection = Connection::GetInstance();
    
                    $resultSet = $this->connection->Execute($query);
                    
                    foreach ($resultSet as $row)
                    {                
                        //$userList = new UserDAOBD();
                        $user = new User();
                        $user->setId($row["userid"]);
                        $user->setEmail($row["email"]);
                        $user->setPassword($row["password"]);
                        $user->setUsername($row["username"]);
                        $user->setFirstName($row["firstName"]);
                        $user->setLastName($row["lastName"]);
                        $user->setDateBirth($row["dateBirth"]);
                        
                        //$user=$userList->GetUserByUserId($row["userid"]);

                        $owner = new Owner();
                        $owner->setOwnerId($row["ownerid"]);
                        $owner->setUser($user);


    
                        array_push($ownerList, $owner);
                    }
    
                    return $ownerList;
                }
                catch(Exception $ex)
                {
                    throw $ex;
                }
        }

        public function UserExistsInOwners($user)
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

        public function GetOwnerByUserId($userId)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (userid = :userid)";

                $parameters["userid"] =  $userId;
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query,$parameters);
                
                $owner = new Owner();
                if (count($resultSet)>0)
                {
                    $resultFirstRow = $resultSet[0];

                    $userList = new UserDAOBD();
                    $user = new User();
                    $user=$userList->GetUserByUserId($resultFirstRow["userid"]);

                    $owner->setOwnerId($resultFirstRow["ownerid"]);
                    $owner->setUser($user);
                }
                return $owner;
            }
            catch (Exception $ex)
            {
                throw $ex;
            }
        }
 
        public function GetOwnerByOwnerId($ownerId)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE (ownerid = :ownerid)";

                $parameters["ownerid"] =  $ownerId;
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query,$parameters);
                
                $owner = new Owner();
                if (count($resultSet)>0)
                {
                    $resultFirstRow = $resultSet[0];

                    $userList = new UserDAOBD();
                    $user = new User();
                    $user=$userList->GetUserByUserId($resultFirstRow["userid"]);

                    $owner->setOwnerId($resultFirstRow["ownerid"]);
                    $owner->setUser($user);
                }
                return $owner;
            }
            catch (Exception $ex)
            {
                throw $ex;
            }
        }
        
    }

?>
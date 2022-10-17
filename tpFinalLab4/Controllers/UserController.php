<?php namespace Controllers;

use Models\User as User;

use DAO\UserDAO as UserDAO;

class UserController{

    private $userDAO;


    public function __construct(){
        $this->userDAO = new UserDAO();
    }

        public function showAddView(){
            require_once(VIEWS_PATH."registerUser.php");
        }
    
        public function showListView(){
            $userList = $this->userDAO->GetAll();
            require_once(VIEWS_PATH."listUsers.php");
        }
        //the parameters must be in order.
        public function Add($username,$email,$password,$firstName,$lastName,$dateBirth){
            
            $user = new User();
            $user->setId($this->AutoIncrementalID());
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setDateBirth($dateBirth);
        
    
            $this->userDAO->Add($user);
    
            $this->showAddView();
        }

        private function AutoIncrementalID(){
            $id = $this->userDAO->getLastid() + 1;
            return $id;
        }
    
        public function Show(){
            $this->showListView();
        }
    
}


    
        


?>
<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;

    class HomeController
    {
        private $userDAO;
        

        public function __construct()
        {
            $this->userDAO = new UserDAO();
            
        }
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }

        public function IndexRegister($message = ""){
            require_once(VIEWS_PATH."registerUser.php");
        }       

        public function Login($email, $password)
        {
            $user = $this->userDAO->GetUserByEmail($email);

            if(($user != null) && ($user->getPassword() === $password))
            {
                $_SESSION["loggedUser"] = $user;
                
                require_once(VIEWS_PATH."loginV.php");
            }
            else
                $this->Index("Usuario y/o Contraseña incorrectos"); // tendría que mandar a ingresar pass y contraseña de vuelta, no al idnex. 
        }                                                           // listo :)

        public function Register($username,$email, $password, $firstName, $lastName,$dateBirth){
            if(!$this->userDAO->isEmailExists($email)){
                if(!$this->userDAO->isUsernameExists($username)){
                    
                $user = $this->Add($username,$email,$password,$firstName,$lastName,$dateBirth);
                $_SESSION["loggedUser"] = $user;

                require_once(VIEWS_PATH."loginV.php");

                }else{
                    $this->IndexRegister("The username already exists");
                }
            }else{
                $this->IndexRegister("The email already exists");
            }
            
        }

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

            return $user;
    
        }

        private function AutoIncrementalID(){
            $id = $this->userDAO->getLastid() + 1;
            return $id;
        }

        public function ShowLoginView()
        {
            require_once(VIEWS_PATH."home.php");
        }

        public function showAddView(){
            require_once(VIEWS_PATH."registerUser.php");
        }
    
        public function showListView(){
            $userList = $this->userDAO->GetAll();
            require_once(VIEWS_PATH."listUsers.php");
        }
    
        public function Show(){
            $this->showListView();
        }
    }
?>
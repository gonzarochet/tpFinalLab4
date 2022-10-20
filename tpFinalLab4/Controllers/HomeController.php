<?php
    namespace Controllers;
    use DAO\UserDAO as UserDAO;

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

        public function Login($email, $password)
        {
            $user = $this->userDAO->GetUserByEmail($email);

            if(($user != null) && ($user->getPassword() === $password))
            {
                $_SESSION["loggedUser"] = $user;
                
                require_once(VIEWS_PATH."options-keeper-owner.php");
            }
            else
                $this->Index("Usuario y/o Contraseña incorrectos"); // tendría que mandar a ingresar pass y contraseña de vuelta, no al idnex. 
        }

        public function ShowLoginView()
        {
            require_once(VIEWS_PATH."loginV.php");
        }
    }
?>
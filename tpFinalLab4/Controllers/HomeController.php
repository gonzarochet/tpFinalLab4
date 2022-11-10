<?php
    namespace Controllers;

    use DAO\BD\UserDAO as UserDAO;
    use Models\User as User;

    class HomeController
    {
        
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }

        public function Logout($message = " "){
            session_destroy();
            require_once(VIEWS_PATH."confirmation-logout.php");
        }
  
    }
?>
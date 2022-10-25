<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;

    class HomeController
    {
        
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }
  
    }
?>
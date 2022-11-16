<?php
namespace Controllers;

use Services\SessionsHelper;

    class HomeController
    {
        
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }

        public function Logout($message = " "){
            SessionsHelper::logoutSession();
            require_once(VIEWS_PATH."confirmation-logout.php");
        }
  
    }
?>
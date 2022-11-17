<?php

namespace Controllers;

//use DAO\JSON\UserDAO as UserDAOBD; //JSON

use DAO\BD\UserDAOBD as UserDAOBD;  //BD


use Exception;
use Models\User as User;
use Services\SessionsHelper as SessionsHelper;

class UserController
{
    private $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAOBD();
    }

    public function IndexRegister($message = "")
    {
        SessionsHelper::logoutSession();
        require_once(VIEWS_PATH . "registerUser.php");
    }

    public function ShowModalUserLogin($message = "")
    {
        require_once(VIEWS_PATH . "/modal/modal-user.php");
    }

    public function Login($email, $password)
    {
        try {
            $user = $this->userDAO->GetUserByEmail($email);
            if (($user != null) && ($user->getPassword() === $password)) {
                SessionsHelper::initUserSession($user);
                $this->changeType();
            } else {
                $message = "The username or password are incorrect";
                $this->ShowLoginView($message);
            }
        } catch (Exception $ex) {
            $this->ShowModalUserLogin($ex->getMessage());
        }
    }

    public function Logout()
    {
        SessionsHelper::logoutSession();
        $this->ShowLoginView();
    }

    public function ShowModalUserRegister($message = "")
    {
        require_once(VIEWS_PATH . "/modal/modal-user-register.php");
    }

    public function Register($username, $email, $password, $firstName, $lastName, $dateBirth)
    {
        $message = "";
        try {
                if (!$this->userDAO->isUsernameOrEmailExists($username,$email)) {
                    $user = $this->Add($username, $email, $password, $firstName, $lastName, $dateBirth);
                    SessionsHelper::initUserSession($user);
                    $this->changeType();
                } else {
                    $message = "The username or email already exists";
                    $this->IndexRegister($message);
                }
            } catch (Exception $ex) {
            $this->ShowModalUserRegister($ex->getMessage());
        }
    }

    private function Add($username, $email, $password, $firstName, $lastName, $dateBirth)
    {
    
        $user = new User();
        //$user->setId($this->AutoIncrementalID());
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setDateBirth($dateBirth);
        $this->userDAO->Add($user);
        $userWithId=$this->userDAO->GetUserByEmail($email); //Para devolver el user completo con el id

        return $userWithId;
        
    }

    public function changeDataProfile()
    {
        SessionsHelper::validateSession();
        require_once(VIEWS_PATH . "change-data-user.php");
    }

    public function changeDataUser($username = " ", $email = "", $password = "", $firstName = "", $lastName = "", $dateBirth = "")
    {
        SessionsHelper::validateSession();
        $user = SessionsHelper::getUserSession();

        try {
            if (!$this->userDAO->isUserExistsAndValidateId($email, $username, $user->getId())) {
                $this->userDAO->updateUser($user->getId(), $username, $email, $password, $firstName, $lastName, $dateBirth);
                require_once(VIEWS_PATH . "confirm-changes-profile.php");
            } else {
                // $this->IndexRegister("El email o el username ya existe");
            }
        } catch (Exception $ex) {
            require_once(VIEWS_PATH . "error-window.php");
        }
    }


    public function changeType()
    {
        SessionsHelper::validateSession();
        require_once(VIEWS_PATH . "loginV.php");
    }

    public function ShowLoginView($message="")
    {
        SessionsHelper::logoutSession();
        require_once(VIEWS_PATH . "home.php");
    }

    public function ShowAddView()
    {
        SessionsHelper::logoutSession();
        require_once(VIEWS_PATH . "registerUser.php");
    }

    

}

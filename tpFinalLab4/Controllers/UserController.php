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
        require_once(VIEWS_PATH . "registerUser.php");
    }

    public function ShowModalUserLogin($message = "", $flag)
    {
        require_once(VIEWS_PATH . "/modal/modal-user.php");
    }

    public function Login($email, $password)
    {
        $message = "";
        $flag = false;
        try {
            $user = $this->userDAO->GetUserByEmail($email);

            if (($user != null) && ($user->getPassword() === $password)) {
                SessionsHelper::initUserSession($user);
                $message = "Succesfully Login";
                $flag = true;
            } else {
                $message = "The username or password are incorrect";
            }
        } catch (Exception $ex) {
            $ex->getMessage();
        } finally {
            $this->ShowModalUserLogin($message, $flag);
        }
    }

    public function Logout()
    {
        SessionsHelper::logoutSession();
        $this->ShowLoginView();
    }

    public function ShowModalUserRegister($message = "", $flag)
    {
        require_once(VIEWS_PATH . "/modal/modal-user-register.php");
    }

    public function Register($username, $email, $password, $firstName, $lastName, $dateBirth)
    {

        $message = "";
        $flag = false;
        try {
            if (!$this->userDAO->isEmailExists($email)) {
                if (!$this->userDAO->isUsernameExists($username)) {
                    $user = $this->Add($username, $email, $password, $firstName, $lastName, $dateBirth);
                    SessionsHelper::initUserSession($user);
                    $flag = true;
                } else {
                    $message = "The username already exists";
                }
            } else {
                $message = "The email already exists";
            }
        } catch (Exception $ex) {
            $message = $ex->getMessage();
        } finally {
            $this->ShowModalUserRegister($message,$flag);
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
        //$userWithId=$this->userDAO->GetUserByEmail($email); //Lo acabo de armar al user, no hace falta buscarlo en el dao

        //return $userWithId;
        return $user;
             
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

    public function ShowLoginView()
    {
        require_once(VIEWS_PATH . "home.php");
    }

    public function ShowAddView()
    {
        require_once(VIEWS_PATH . "registerUser.php");
    }

    

}

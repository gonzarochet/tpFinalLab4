<?php

namespace Controllers;

use DAO\JSON\UserDAO as UserDAOBD;
//use DAO\BD\UserDAOBD as UserDAOBD;
//use Dao\JSON\PetDAO AS PET
use Exception;
use Models\User as User;

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

    public function Login($email, $password)
    {
            $user = $this->userDAO->GetUserByEmail($email);

            if(($user != null) && ($user->getPassword() === $password))
            {
                $_SESSION["loggedUser"] = $user;
                
                require_once(VIEWS_PATH."loginV.php");
            }
            else{
                echo "<script> if(confirm('Verifique que los datos ingresados sean correctos'));";
                echo "window.location = '../index.php';
                </script>"; 
            }                                                          

    } 

    public function Logout()
    {
        session_destroy();
        $this->ShowLoginView();

    }

    public function Register($username, $email, $password, $firstName, $lastName, $dateBirth)
    {
        if (!$this->userDAO->isEmailExists($email)) {
            if (!$this->userDAO->isUsernameExists($username)) {

                $user = $this->Add($username, $email, $password, $firstName, $lastName, $dateBirth);
                $_SESSION["loggedUser"] = $user;


                require_once(VIEWS_PATH . "loginV.php");
            } else {
                $this->IndexRegister("The email already exists");
            }
        } else {
            $this->IndexRegister("The email already exists");
        }
    }

    public function Add($username, $email, $password, $firstName, $lastName, $dateBirth)
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

    public function changeDataProfile(){
        require_once(VIEWS_PATH."change-data-user.php");
    }

    public function changeDataUser($username=" ", $email="", $password = "",$firstName= "", $lastName="",$dateBirth = "") 
    {
        $user = $_SESSION["loggedUser"];

        try{
            if(!$this->userDAO->isUserExistsAndValidateId($email,$username,$user->getId())){
            $this->userDAO->updateUser($user->getId(),$username,$email,$password,$firstName,$lastName,$dateBirth);
                require_once(VIEWS_PATH."confirm-changes-profile.php");
            }else{
           // $this->IndexRegister("El email o el username ya existe");
            }
        }catch(Exception $ex){
            require_once(VIEWS_PATH."error-window.php");
        }

    }


    public function changeType(){
        require_once(VIEWS_PATH."loginV.php");
    }


    public function ShowLoginView()
    {
        require_once(VIEWS_PATH . "home.php");
    }

    public function ShowAddView()
    {
        require_once(VIEWS_PATH . "registerUser.php");
    }

    public function ShowListView()
    {
        $userList = $this->userDAO->GetAll();
        require_once(VIEWS_PATH . "listUsers.php");
    }
}
?>
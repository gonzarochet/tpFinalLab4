<?php

namespace Services;

use Models\Keeper;
use Models\User;
use Models\Owner;

class SessionsHelper
{
    public static function initUserSession($user)
    {
        $_SESSION["loggedUser"] = $user;
    }

    public static function getUserSession()
    {
        $user = null;
        if (isset($_SESSION["loggedUser"])) {
            $user = new User();
            $user = $_SESSION["loggedUser"];
        }
        return $user;
    }

    public static function validateSession()
    {
        if (!isset($_SESSION["loggedUser"])) {
            header("location:../index.php");
        }
    }

    public static function sessionUserExist()
    {
        $flag = true;
        if (!isset($_SESSION["loggedUser"])) {
            $flag = false;
        }
        return $flag;
    }


    public static function logoutSession()
    {
        session_destroy();
    }

    public static function initOwnerSession($owner)
    {
        $_SESSION["loggedOwner"] = $owner;
        $_SESSION["type"] = "owner";
    }

    public static function getOwnerSession()
    {
        $owner = null;
        if (isset($_SESSION["loggedOwner"])) {
            $owner = new Owner();
            $owner = $_SESSION["loggedOwner"];
        }
        return $owner;
    }

    public static function validateSessionOwner()
    {
        if (!isset($_SESSION["loggedOwner"]) && !isset($_SESSION["loggedUser"])) {
            if ($_SESSION["type"] != "owner") {
                header("location:../index.php");
            }
            header("location:../index.php");
        }
    }

    public static function sessionOwnerExist()
    {
        $flag = true;
        if (!isset($_SESSION["loggedOwner"])) {
            $flag = false;
        }
        return $flag;
    }


    public static function initKeeperSession($keeper)
    {
        $_SESSION["loggedKeeper"] = $keeper;
        $_SESSION["type"] = "keeper";
    }

    public static function getKeeperSession()
    {
        $keeper = null;
        if (isset($_SESSION["loggedKeeper"])) {
            $keeper = new Keeper();
            $keeper = $_SESSION["loggedKeeper"];
        }
        return $keeper;
    }


    public static function validateSessionKeeper()
    {
        if (!isset($_SESSION["loggedKeeper"]) && !isset($_SESSION["loggedUser"])) {
            if ($_SESSION["type"] != "keeper") {
                header("location:../index.php");
            }
            header("location:../index.php");
        }
    }

    public static function sessionKeeperExist()
    {
        $flag = true;
        if (!isset($_SESSION["loggedKeeper"])) {
            $flag = false;
        }
        return $flag;
    }


    public static function getSessionType(){
        $type = "";
        if(isset($_SESSION["type"])){
            $type = $_SESSION["type"];
        }
        return $type;

    }
}

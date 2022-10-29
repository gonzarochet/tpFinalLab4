<?php namespace Config;

define("ROOT",dirname(__DIR__). "/");

// This root folder will change with each project. 
define("FRONT_ROOT", "/tpFinalLab4/tpFinalLab4/");
define("VIEWS_PATH", "Views/");
define("CSS_PATH",FRONT_ROOT.VIEWS_PATH."css/");
//define("JS_PATH",FRONT_ROOT.VIEWS_PATH."js/");
define("IMAGES_PATH",FRONT_ROOT.VIEWS_PATH."images/");

define("DB_HOST", "localhost");
define("DB_NAME", "pethero");
define("DB_USER", "root");
define("DB_PASS", "");
?>
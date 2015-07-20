<?php
session_start();    //Start session
date_default_timezone_set("Asia/Ho_Chi_Minh");  //set default time zone

define('ROOT',dirname(realpath(__FILE__)) . "/");   //define root directory
define('DIR_UPLOAD', ROOT . 'public/uploads/');     //define upload diretory

/*
 * load config files and function common
 */
require_once(ROOT . 'system/configs/rounter.php');
require_once(ROOT . 'system/configs/config.php');
require_once(ROOT . 'system/configs/validationNotify.php');
require_once(ROOT . 'lib/functions.php');

$url = $_GET['url'];   //Lấy url

$host = $_SERVER['HTTP_HOST'];
$self = $_SERVER['PHP_SELF'];
$arrayUrl = array();
$arrayUrl = explode('/', $self);
$base_url = "http://" . $host . "/" . $arrayUrl[1];

define('BASE_URL', $base_url);      //define base url 

/*
 * Function load controller and action
 */
function load() {
    global $url;
    global $area;
    $url = rtrim($url,"/");
    $urlArray = array();
    $urlArray = explode("/",$url);
    
    $controller = DEFAULT_CONROLLER;
    $action = DEFAULT_ACTION;
    
    if($urlArray[0] == "admin") {
        $area = "admin";
        array_shift($urlArray);
    }
    
    
    if(!empty($urlArray[0])) {
        $controller = array_shift($urlArray);
    }
    
    
    if(!empty($urlArray[0])) {
        $action = array_shift($urlArray);
    }
    

    $controllerName = $controller;
    $controller = ucwords($controller);
    $controller .= 'Controller';
    $dispatch = new $controller();
    
    if (method_exists($controller, $action)) {
        call_user_func(array($dispatch,$action));
    } else {
        echo "Controller or action not found.";
    }
}

/*
 * Function autoload class
 */

function __autoload($className) {
    $paths = array(
        ROOT."/lib/",
        ROOT."/admin/controller/",
        ROOT."/admin/model/",
        ROOT."/home/controller/"
    );
    foreach($paths as $path) {
        if(file_exists($path.$className.".class.php")){
            require_once($path.$className.".class.php");
            break;
        }
    }
}

Database::getInstance('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS);
$area = "home";
load();



<?php
define('ROOT',dirname(realpath(__FILE__)) . "/");
define('BASE_URL', 'http://localhost/ntq-project');

include(ROOT . 'system/configs/config.php');
include(ROOT . 'lib/functions.php');


function setErrorLogging(){
    if(DEVELOPMENT_ENVIRONMENT == true) {
        error_reporting(E_ALL);
        ini_set('display_errors', "1");
    } else {
        error_reporting(E_ALL);
        ini_set('display_errors', "0");
    }
    ini_set('log_errors', "1");
    ini_set('error_log',ROOT . 'system/logs/error_log.php');
}


function callHook() {
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
    
    
    if(isset($urlArray[0]) && !empty($urlArray[0])) {
        $controller = array_shift($urlArray);
    }
    
    
    if(isset($urlArray[0]) && !empty($urlArray[0])) {
        $action = array_shift($urlArray);
    }
    
    
    Database::getInstance('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS);
    
    
    $controllerName = $controller;
    $controller = ucwords($controller);
    $model = rtrim($controller, 's');
    $controller .= 'Controller';
    $dispatch = new $controller();
    
    
    if ((int)method_exists($controller, $action)) {
        call_user_func(array($dispatch,$action));
    } else {
        error_log("Unknown page/action, Controller = ".$controller.", action = ".$action);
    }
}

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

function unregisterGlobals() {
    if (ini_get('register_globals')) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach ($array as $value) {
            foreach ($GLOBALS[$value] as $key => $var) {
                if ($var === $GLOBALS[$key]) {
                    unset($GLOBALS[$key]);
                }
            }
        }
    }
}


$area = "home";
unregisterGlobals();
setErrorLogging();
callHook();



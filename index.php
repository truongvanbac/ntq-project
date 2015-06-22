<?php
define('ROOT',dirname(realpath(__FILE__)) . "/");   //Đường dẫn đến thư mục chứa project
define('BASE_URL', 'http://localhost/ntq-project'); //Base url 
define('DIR_UPLOAD', ROOT . 'public/uploads/');     //Đường dẫn đến thư mục uploads hình ảnh

include(ROOT . 'system/configs/config.php');    //Include file config
include(ROOT . 'lib/functions.php');    //Include function dùng chung

@$url = $_GET['url'];   //Lấy url


//Load controller và action
function load() {
    global $url;
    global $area;
    $url = rtrim($url,"/");
    $urlArray = array();
    $urlArray = explode("/",$url);  //Tách chuỗi url thành mảng
    
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

//Autoload các calss
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

$area = "home";
load();



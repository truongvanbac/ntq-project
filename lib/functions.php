<?php

//Khởi tạo Header html
function startHeader() {
    $string = "<!DOCTYPE html>\n<html>\n<head>\n";
    echo $string;
}

//Include css
function includeStyle($filename) {
    global $area;
    $path =  BASE_URL . "/public/" . $area . "/css/" . $filename;
    includeExternalStyle($path);
}


function includeExternalStyle($location) {
    $string = "<link rel='stylesheet' type='text/css' href='".$location."' />\n";
    echo $string;
}


//Include script
function includeScript($filename) {
    global $area;
    $path = BASE_URL . "/public/" . $area . "/js/" . $filename;
    includeExternalScript($path);
}

function includeExternalScript($location) {
    $string = "<script type='text/javascript' src='".$location."'></script>\n";
    echo $string;
}

//Set title
function setTitle($title) {
    echo "<title>" . $title . "</title>\n";
}

//Kết thúc herder html 
function endHeader() {
    echo "</head>\n<body>\n";
}

//Đóng thẻ html
function getFooter() {
    echo "\n</body>\n</html>";
}

//Include image 
function includeImage($folder, $img) {
    global $area;
    $path =BASE_URL . "/public/" . $area . "/img/" . $folder . $img;
    return $path;
}


//Lấy image đã uploda
function getImage($imgName) {
    $path =BASE_URL . "/public/uploads/" . $imgName;
    echo $path;
}


//Thong bao script su kien
function notifyScript($stringNotify) {
    echo "<script>";
    echo "alert('$stringNotify');";
    echo "</script>";
}

//Chuyen huong bang script
function directScript($stringNotify, $location) {
    echo "<script>";
    echo "setTimeout(
        function() {
            alert('$stringNotify');
            window.location = ('$location');
        }
    , 500);";
    echo "</script>";
}

//Chuyen ve dinh dang tien chua cac dau cham
function moneyFormat($value) {
    $data = array();
    $count = count($value);
    $result = number_format($value, ((int)$count/3), "," , ".");
    return $result;
}

function redirect($location) {
    if(!empty($location)) {
        header("location: " . $location);
    }
}


function getMethod($item) {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST': 
            return $_POST[$item]; 
            break;
        case 'GET':
            return $_GET[$item];
            break;
    }
}

function urlAnalyze() {
    global $url;
    $url = rtrim($url, "/");
    $urlArray = array();
    $urlArray = explode("/", $url);
    return $urlArray;
}


?>
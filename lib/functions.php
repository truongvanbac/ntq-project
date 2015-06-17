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

?>
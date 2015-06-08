<?php


function startHeader() {
    $string = "<!DOCTYPE html>\n<html>\n<head>\n";
    echo $string;
}

function includeImage($folder, $img) {
    global $area;
    $path =BASE_URL . "/public/" . $area . "/img/" . $folder . $img;
    return $path;
}


function includeStyle($filename) {
    global $area;
    $path =  BASE_URL . "/public/" . $area . "/css/" . $filename;
    includeExternalStyle($path);
}

function includeExternalStyle($location) {
    $string = "<link rel='stylesheet' type='text/css' href='".$location."' />\n";
    echo $string;
}

function includeScript($filename) {
    global $area;
    $path = "../" . $area . "/js/" . $filename;
    includeExternalScript($path);
}

function includeExternalScript($location) {
    $string = "<script type='text/css' src='".$location."'></script>\n";
    echo $string;
}

function setTitle($title) {
    echo "<title>" . $title . "</title>\n";
}

function endHeader() {
    echo "</head>\n<body>\n";
}

function getFooter() {
    echo "\n</body>\n</html>";
}

?>
<?php

/**
 * Start header html
 */
function startHeader() {
    $string = "<!DOCTYPE html>\n<html>\n<head>\n";
    echo $string;
}

/**
 * Include style css
 */
function includeStyle($filename) {
    global $area;
    $path =  BASE_URL . "/public/" . $area . "/css/" . $filename;
    includeExternalStyle($path);
}

/**
 * Include style css html
 */
function includeExternalStyle($location) {
    $string = "<link rel='stylesheet' type='text/css' href='".$location."' />\n";
    echo $string;
}


/**
 * Include script
 */
function includeScript($filename) {
    global $area;
    $path = BASE_URL . "/public/" . $area . "/js/" . $filename;
    includeExternalScript($path);
}


/**
 * Include script html
 */
function includeExternalScript($location) {
    $string = "<script type='text/javascript' src='".$location."'></script>\n";
    echo $string;
}

/**
 * start title html
 */
function setTitle($title) {
    echo "<title>" . $title . "</title>\n";
}

/**
 * End header html
 */
function endHeader() {
    echo "</head>\n<body>\n";
}

/**
 * End tag html
 */
function getFooter() {
    echo "\n</body>\n</html>";
}

/**
 * Include path image
 */

function includeImage($folder, $img) {
    global $area;
    $path =BASE_URL . "/public/" . $area . "/img/" . $folder . $img;
    return $path;
}


/**
 * Get image
 */
function getImage($imgName) {
    $path =BASE_URL . "/public/uploads/" . $imgName;
    echo $path;
}


/**
 * Notify script
 */
function notifyScript($stringNotify) {
    echo "<script>";
    echo "alert('$stringNotify');";
    echo "</script>";
}


/**
 * Redirect page with javascript
 */
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


/**
 * Tranfer money format
 */
function moneyFormat($value) {
    $data = array();
    $count = count($value);
    $result = number_format($value, ((int)$count/3), "," , ".");
    return $result;
}

/**
 * Redirect page
 */
function redirect($location) {
    if(!empty($location)) {
        header("location: " . $location);
    }
}


/**
 * Get value posted
 */
function getValue($item) {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST': 
            return $_POST[$item]; 
            break;
        case 'GET':
            return $_GET[$item];
            break;
    }
}

/**
 * Return array of url getted
 */
function urlAnalyze() {
    global $url;
    $url = rtrim($url, "/");
    $urlArray = array();
    $urlArray = explode("/", $url);
    return $urlArray;
}

/**
 * Format data input
 */
function test_input($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Delete file
 */

function deleteFile($file) {
    $path = DIR_UPLOAD . basename($file);
    return unlink($path);
}

/**
 * Get path link
 */
function pathShow($model, $field, $type, $page, $search) {
    $path = '';
    if(empty($_GET['search'])) {            //if not searching data
        $path = BASE_URL . $model . '?field=' . $field . '&type=' . $type . '&page=' . $page;
    } else {
        $path = BASE_URL . $model . '?search=' . $search . '&field=' . $field . '&type=' . $type . '&page=' . $page;
    }
    echo $path;
}

?>
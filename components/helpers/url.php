<?php


function parseUrl() {
    $url = parse_url($_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
    
    $urlData = explode('/', $url['path']);
    
    $i = 0;
    if ($urlData[1] == "index.php") {
        $i = 1;
    }
    
    return array_slice($urlData,$i+1);
}



?>

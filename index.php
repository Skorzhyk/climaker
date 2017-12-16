<?php

include_once 'Router.php';

if (!$q = strpos($_SERVER['REQUEST_URI'], '?')) {
    $q = strlen($_SERVER['REQUEST_URI']);
}

$url = explode('/', substr($_SERVER['REQUEST_URI'], 1, $q - 1));

$router = new Router();
$engine = $router->setEngine($url[0]);
require_once 'Model/' . $engine . '.php';
$engine = new $engine();
$engine->executeAPI($url[1], $_REQUEST);








//$myCurl = curl_init();
//curl_setopt_array($myCurl, array(
//    CURLOPT_URL => 'https://api.github.com/users/skorzhyk',
//    CURLOPT_RETURNTRANSFER => true
//));
//$response = curl_exec($myCurl);
//curl_close($myCurl);
//
//echo $response;





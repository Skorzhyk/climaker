<?php

include_once 'Router.php';

if (!$q = strpos($_SERVER['REQUEST_URI'], '?')) {
    $q = strlen($_SERVER['REQUEST_URI']);
}

$url = explode('/', substr($_SERVER['REQUEST_URI'], 1, $q - 1));

if ($_SERVER['REQUEST_URI'] != '/') {
    $router = new Router();
    $engine = $router->setEngine($url[0]);
    require_once 'Model/' . $engine . '.php';
    $engine = new $engine();
    $engine->executeAPI($url[1], json_decode($_REQUEST['data'], true));
}

if ($_SERVER['REQUEST_URI'] == '/') {
    $user = json_encode([
        'email' => 'korzhyk@mail.ru',
        'password' => 'fhdfsdhdjs',
        'name' => 'Sergei',
        'surname' => 'Filonich',
        'telephone_number' => '0956784343'
    ]);

    $id = json_encode([
        'id' => 1
    ]);

    $login = json_encode([
        'email' => 'skorzhyk@mail.ru',
        'password' => 'fhdfsdhdjs'
    ]);

    $room = json_encode([
        'name' => 'isom',
        'user_id' => 1,
        'current_temperature' => '34,45',
        'current_humidity' => '56,3',
        'custom_temperature' => '34',
        'custom_humidity' => '56,6'
    ]);

    $climate = json_encode([
        'id' => 1,
        'current_temperature' => '33',
        'current_humidity' => '59',
    ]);

    $template = json_encode([
        'id' => 1,
        'temperature' => '90',
        'humidity' => '90',
    ]);

    $myCurl = curl_init();
    curl_setopt_array($myCurl, array(
        CURLOPT_URL => 'http://climaker.dev/template/delete',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => 'data=' . $id
    ));
    $response = curl_exec($myCurl);
    curl_close($myCurl);

    var_dump($response);
}





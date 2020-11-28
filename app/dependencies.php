<?php

$container = $app->getContainer();
//$container['my_service'] = function ($c) {
//    return 'My service in action.';
//};
$container['view'] = new \Slim\Views\PhpRenderer('../app/Views/', [
    'baseUrl' => 'http://localhost:8000',
]);

$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager();
    $capsule->addConnection($container['settings']['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
};
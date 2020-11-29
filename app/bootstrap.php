<?php

use App\Services\CategoriesFactory;

$capsule = new \Illuminate\Database\Capsule\Manager();
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container->view->addAttribute('categories', CategoriesFactory::create());

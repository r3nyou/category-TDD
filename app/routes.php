<?php

use App\Controllers\HomeController;
use App\Controllers\CategoryController;

$app->get('/', HomeController::class . ':home');
$app->get('/delete-category', CategoryController::class . ':deleteCategory');

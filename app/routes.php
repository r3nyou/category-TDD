<?php

use App\Controllers\HomeController;

$app->get('/hello/{name}', HomeController::class . ':home');

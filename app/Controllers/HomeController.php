<?php

namespace App\Controllers;

use App\Models\Category;

class HomeController extends BaseController
{
    public function home($request, $response, $args)
    {
        $response = $this->container->view->render($response, 'view.phtml');
        return $response;
    }
}
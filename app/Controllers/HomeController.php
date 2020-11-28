<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function home($request, $response, $args)
    {
        return print_r(
            $this->container->db->table('categories')->where('name', 'Electronics')->get()
        );
        $response = $this->container->view->render($response, 'view.phtml');
        return $response;
    }
}
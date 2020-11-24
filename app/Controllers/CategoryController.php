<?php

namespace App\Controllers;

class CategoryController extends BaseController
{
    public function deleteCategory($request, $response, $args)
    {
        $response = $this->container->view->render($response, 'view.phtml', [
            'category_delete' => true,
        ]);
        return $response;
    }
}
<?php

namespace App\Controllers;

class CategoryController extends BaseController
{
    public function deleteCategory($request, $response, $args)
    {
        $category_id = $args['id'];
        /** @todo  delete form database */
        $response = $this->container->view->render($response, 'view.phtml', [
            'category_delete' => true,
        ]);
        return $response;
    }

    public function showCategory($request, $response, $args)
    {
        $category_id = $args['id'];
        $category = 'Electronics';
        $response = $this->container->view->render($response, 'view.phtml', [
            'category' => $category,
        ]);
        return $response;
    }
}
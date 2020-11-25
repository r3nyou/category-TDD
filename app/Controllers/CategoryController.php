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

    public function editCategory($request, $response, $args)
    {
        $category_id = $args['id'];
        $category = ['name' => 'Electronics', 'parent' => null];
        $response = $this->container->view->render($response, 'view.phtml', [
            'editCategory' => $category,
        ]);
        return $response;
    }

    public function saveCategory($request, $response, $args)
    {
        $data = $request->getParsedBody();
        if (empty($data['category_name']) || empty($data['category_description'])) {
            $categorySaved = false;
        } else {
            $categorySaved = true;
        }
        $response = $this->container->view->render($response, 'view.phtml', [
            'categorySaved' => $categorySaved,
        ]);
        return $response;
    }
}
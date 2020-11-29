<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Capsule\Manager;

class CategoriesFactory
{
    public static function create(): string
    {
        $capsule = new Manager();
        $capsule->addconnection([
            'driver'    => 'sqlite',
            'host'      => 'localhost',
            'database'  => '/users/marcusjian/self-projects/category-tdd/app/database/db.sqlite',
            'username'  => 'user',
            'password'  => 'password',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);
        $capsule->setasglobal();
        $capsule->booteloquent();
        $categories = Category::all()->toArray();
        $htmlList = new HtmlList();
        $convertedArray = $htmlList->convert($categories);
        return $htmlList->makeUlList($convertedArray);
    }
}
<?php

use App\Models\Category;
use Illuminate\Database\Schema\Blueprint;

class BackendStuffTest extends PHPUnit_Extensions_Selenium2TestCase
{
    public static function setUpBeforeClass()
    {
        $capsule = new \Illuminate\Database\Capsule\Manager();
        $capsule->addConnection([
            'driver'    => 'sqlite',
            'host'      => 'localhost',
            'database'  => '/Users/marcusjian/self-projects/category-TDD/app/database/db.sqlite',
            'username'  => 'user',
            'password'  => 'password',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        $capsule::schema()->dropIfExists('categories');
        $capsule::schema()->create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable(false);
            $table->bigInteger('parent_id')->unsigned()->nullable();
        });
        Category::create([
            'name' => 'Electronics-test'
        ]);
    }

    public function setUp()
    {
        $this->setBrowserUrl('http://localhost:8000');
        $this->setBrowser('chrome');
        $this->setDesiredCapabilities(['chromeOption' => ['w3c' => false]]);
    }

//    public function testCanSeeAddedCategories()
//    {
//        $this->url('');
//
//        $element = $this->byXPath('//ul[@class="dropdown menu"]/li[2]/a');
//        $href = $element->attribute('href');
//        $this->assertRegExp('@^http://localhost:8000/show-category/[0-9]+,Electronics@',$href);
//
//        $this->url('show-category/1');
//        $element = $this->byXPath('//ul[@class="dropdown menu"]/li[2]/a');
//        $href = $element->attribute('href');
//        $this->assertRegExp('@^http://localhost:8000/show-category/[0-9]+,Electronics@',$href);
//    }
}
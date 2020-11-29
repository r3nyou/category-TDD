<?php

use App\Models\Category;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;

class BackendStuffTest extends PHPUnit_Extensions_Selenium2TestCase
{
    public static function setUpBeforeClass()
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

        $capsule::schema()->dropIfExists('categories');
        $capsule::schema()->create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable(false);
            $table->bigInteger('parent_id')->unsigned()->nullable();
        });
    }

    public function setUp()
    {
        $this->setBrowserUrl('http://localhost:8000');
        $this->setBrowser('chrome');
        $this->setDesiredCapabilities(['chromeOption' => ['w3c' => false]]);
    }

//    public function testCanSeeAddedCategories()
//    {
//            Category::create([
//                'name' => 'Electronics-test'
//            ]);
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

    public function testCanAddChildCategories()
    {
        Category::create([
            'name' => 'Electronics'
        ]);
        $parentCategory = Category::where('name', 'Electronics')->first();

        $childCategory = new Category();
        $childCategory->name = 'Monitors';
        $parentCategory->children()->save($childCategory);

        $this->url('');
        $element = $this->byXPath('//ul[@class="dropdown menu"]/li[2]/ul[1]/li[1]/a');
        $href = $element->attribute('href');
        $this->assertRegExp('@^http://localhost:8000/show-category/[0-9]+,Monitors@',$href);
    }
}
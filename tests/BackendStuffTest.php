<?php

use Illuminate\Support\Manager;
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
        $capsule::schema()->create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable(false);
            $table->bigInteger('parent_id')->unsigned()->nullable();
        });
        $capsule::table('categories')->insert(
            ['name' => 'Electronics']
        );
    }

    public function setUp()
    {
        $this->setBrowserUrl('http://localhost:8000');
        $this->setBrowser('chrome');
        $this->setDesiredCapabilities(['chromeOption' => ['w3c' => false]]);
    }

    public function testCanSeeCorrectStringOnMainPage()
    {
        $this->url('');
        $this->assertContains('Electronics', $this->source());
    }
}
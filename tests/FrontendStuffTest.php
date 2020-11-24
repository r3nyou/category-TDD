<?php

//require 'vendor/autoload.php';

use PHPUnit\Extensions\Selenium2TestCase;

class FrontendStuffTest extends Selenium2TestCase
{
    public function setUp(): void
    {
        $this->setBrowserUrl('http://localhost:8000/');
        $this->setBrowser('chrome');
        $this->setDesiredCapabilities(['chormeOptions' => ['w3c' => false]]);
    }

    public function testCanSeeCorrectStringsOnMainPage()
    {
        $this->url('');
        $this->assertContains('Add a new category', $this->source());
    }
}
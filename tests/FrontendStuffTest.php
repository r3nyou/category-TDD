<?php

class FrontendStuffTest extends PHPUnit_Extensions_Selenium2TestCase
{
    public function setUp(): void
    {
        $this->setBrowserUrl('http://localhost:8000/');
        $this->setBrowser('chrome');
        $this->setDesiredCapabilities(['chromeOptions' => ['w3c' => false]]);
    }

    public function testCanSeeCorrectStringsOnMainPage()
    {
        $this->url('');
        $this->assertContains('Add a new category', $this->source());
    }
}
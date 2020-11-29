<?php

namespace integration;

use PHPUnit\Framework\TestCase;
use App\Services\CategoriesFactory;

class CategoriedFactoryTest extends TestCase
{
    public function testCanProduceStringBasedOnArray()
    {
        $this->assertTrue(is_string(CategoriesFactory::create()));
    }
}
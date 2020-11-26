<?php


use App\Services\CategoryTree;
use PHPUnit\Framework\TestCase;

class CategoryTreeTest extends TestCase
{
    public function testCanConvertDatabaseResultToCategoryArray()
    {
        $dbResult = [
            ['id' => 1, 'name' => 'Electronics', 'parent_id' => null],
            ['id' => 2, 'name' => 'Videos', 'parent_id' => null],
            ['id' => 3, 'name' => 'Software', 'parent_id' => null],
        ];
        $afterResult = [
            [
                'id' => 1,
                'name' => 'Electronics',
                'parent_id' => null,
                'children' => []
            ],
            [
                'id' => 2,
                'name' => 'Videos',
                'parent_id' => null,
                'children' => []
            ],
            [
                'id' => 3,
                'name' => 'Software',
                'parent_id' => null,
                'children' => []
            ],
        ];

        $tree = new CategoryTree();
        $this->assertEquals($afterResult, $tree->convert($dbResult));
    }

    public function testCanConvertDatabaseResultToOneLevelNestedArray()
    {
        $dbResult = [
            ['id' => 1, 'name' => 'Electronics', 'parent_id' => null],
            ['id' => 2, 'name' => 'Computers', 'parent_id' => 1],
        ];

        $afterResult = [
            [
                'id' => 1,
                'name' => 'Electronics',
                'parent_id' => null,
                'children' => [
                    [
                        'id' => 2,
                        'name' => 'Computers',
                        'parent_id' => 1,
                        'children' => []
                    ]
                ]
            ],
        ];
        $tree = new CategoryTree();
        $this->assertEquals($afterResult, $tree->convert($dbResult));
    }

    public function testCanConvertDatabaseResultToTwoLevelNestedArray()
    {
        $dbResult = [
            ['id' => 1, 'name' => 'Electronics', 'parent_id' => null],
            ['id' => 2, 'name' => 'Computers', 'parent_id' => 1],
            ['id' => 3, 'name' => 'Laptops', 'parent_id' => 2],
        ];

        $afterResult = [
            [
                'id' => 1,
                'name' => 'Electronics',
                'parent_id' => null,
                'children' => [
                    [
                        'id' => 2,
                        'name' => 'Computers',
                        'parent_id' => 1,
                        'children' => [
                            [
                                'id' => 3,
                                'name' => 'Laptops',
                                'parent_id' => 2,
                                'children' => []
                            ]
                        ]
                    ]
                ]
            ],
        ];
        $tree = new CategoryTree();
        $this->assertEquals($afterResult, $tree->convert($dbResult));
    }
}

<?php


use App\Services\CategoryTree;
use PHPUnit\Framework\TestCase;

class CategoryTreeTest extends TestCase
{
    private $tree;

    public function setUp()
    {
        $this->tree = new CategoryTree();
    }

    /**
     * @dataProvider arrayProvider
     */
    public function testCanConvertDatabaseResultToNestedCategoryArray($dbResult, $afterResult)
    {
        $this->assertEquals($afterResult, $this->tree->convert($dbResult));
    }

    public function arrayProvider()
    {
        return [
            'oneLevel' => [
                [
                    ['id' => 1, 'name' => 'Electronics', 'parent_id' => null],
                    ['id' => 2, 'name' => 'Videos', 'parent_id' => null],
                    ['id' => 3, 'name' => 'Software', 'parent_id' => null],
                ],
                [
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
                ]
            ],
            'twoLevel' => [
                [
                    ['id' => 1, 'name' => 'Electronics', 'parent_id' => null],
                    ['id' => 2, 'name' => 'Computers', 'parent_id' => 1],
                ],
                [
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
                ]
            ],
            'threeLevel' => [
                [
                    ['id' => 1, 'name' => 'Electronics', 'parent_id' => null],
                    ['id' => 2, 'name' => 'Computers', 'parent_id' => 1],
                    ['id' => 3, 'name' => 'Laptops', 'parent_id' => 2],
                ],
                [
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
                ]
            ],
        ];
    }
}

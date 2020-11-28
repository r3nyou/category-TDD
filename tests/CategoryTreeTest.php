<?php


use App\Services\HtmlList;
use App\Services\SelectList;
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

    /**
     * @dataProvider arrayProvider
     */
    public function testCanProduceHtmlNestedCategories(
        array $dbArray,
        array $afterResult,
        string $htmlList,
        array $htmlSelectList
    ) {
        $html = new HtmlList();
        $afterConversionDb = $html->convert($dbArray);
        $this->assertEquals($htmlList, $html->makeUlList($afterConversionDb));

        $selectList = new SelectList();
        $this->assertEquals($htmlSelectList, $selectList->makeSelectList($afterConversionDb));
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
                ],
                '<ul><li>Electronics</li><li>Videos</li><li>Software</li></ul>',
                [
                    ['name' => 'Electronics'],
                    ['name' => 'Videos'],
                    ['name' => 'Software'],
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
                ],
                '<ul><li>Electronics<ul><li>Computers</li></ul></li></ul>',
                [
                    ['name' => 'Electronics'],
                    ['name' => '&nbsp;&nbsp;Computers'],
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
                ],
                '<ul><li>Electronics<ul><li>Computers<ul><li>Laptops</li></ul></li></ul></li></ul>',
                [
                    ['name' => 'Electronics'],
                    ['name' => '&nbsp;&nbsp;Computers'],
                    ['name' => '&nbsp;&nbsp;&nbsp;&nbsp;Laptops'],
                ]
            ],
        ];
    }
}

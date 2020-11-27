<?php

namespace App\Services;

class SelectList extends CategoryTree
{
    private $categoryList = [];

    public function makeSelectList(array $convertDbArray, $repeat = 0): array
    {
        foreach ($convertDbArray as $val) {
            $this->categoryList[] = ['name' => str_repeat('&nbsp;', $repeat) . $val['name']];
            if (!empty($val['children'])) {
                $this->makeSelectList($val['children'], $repeat + 2);
            }
        }
        return $this->categoryList;
    }
}
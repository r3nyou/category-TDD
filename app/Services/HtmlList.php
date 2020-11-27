<?php

namespace App\Services;

class HtmlList extends CategoryTree
{
    private $categoryList;

    public function makeUlList(array $convertDbArray): string
    {
        $this->categoryList .= '<ul>';
        foreach ($convertDbArray as $val) {
            $this->categoryList .= '<li>' . $val['name'];
            if (!empty($val['children'])) {
                $this->makeUlList($val['children']);
            }
            $this->categoryList .= '</li>';
        }
        $this->categoryList .= '</ul>';

        return $this->categoryList;
    }
}
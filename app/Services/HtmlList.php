<?php

namespace App\Services;

class HtmlList extends CategoryTree
{
    private $categoryList;

    public function makeUlList(array $convertedDbArray)
    {
        foreach ($convertedDbArray as $value)
        {
            $this->categoryList .= '<li><a href="http://localhost:8000/show-category/'.$value['id'].','.$value['name'].'">'.$value['name'].'</a>';
            if (!empty($value['children']))
            {
                $this->categoryList .= '<ul class="submenu menu vertical" data-submenu>';
                $this->makeUlList($value['children']);
                $this->categoryList .= '</ul>';
            }
            $this->categoryList .= '</li>';
        }
        return $this->categoryList;
    }
}
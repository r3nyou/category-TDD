<?php

namespace App\Services;

class CategoryTree
{
    public function convert(array $dbArray, int $parentId = null): array
    {
        $nestedCategories = [];
        foreach ($dbArray as $category) {
            $category['children'] = [];
            if ($category['parent_id'] == $parentId) {
                $children = $this->convert($dbArray, $category['id']);
                if ($children) {
                    $category['children'] = $children;
                }
                $nestedCategories[] = $category;
            }
        }

        return $nestedCategories;
    }
}
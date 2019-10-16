<?php
declare(strict_types=1);

namespace PlnaPenezenka\Api\DataTransformer;

use PlnaPenezenka\Api\Shops\Category;

class CategoryArrayTransformer
{
    public function transform(array $data): Category
    {
        $category = new Category();
        $category->setId($data['id']);
        $category->setParentId($data['parent_id']);
        $category->setTitle($data['title']);
        $category->setDescription($data['description']);
        $category->setImageUrl($data['image_url']);
        $category->setLink($data['link']);
        $category->setSlug($data['slug']);
        $category->setShopsCount($data['shops_count']);

        return $category;
    }
}

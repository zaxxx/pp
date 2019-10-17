<?php
declare(strict_types=1);

namespace Tests\Unit\PlnaPenezenka\Api\DataTransformer;

use PHPUnit\Framework\TestCase;
use PlnaPenezenka\Api\DataTransformer\CategoryArrayTransformer;
use PlnaPenezenka\Api\Shops\Category;

class CategoryArrayTransformerTest extends TestCase
{
    public function testTransformerCreatesCategory(): void
    {
        $data = [
            'id' => 1,
            'parent_id' => null,
            'title' => 'foo',
            'description' => 'bar',
            'link' => 'https://google.com',
            'slug' => 'foo',
            'shops_count' => 1,
        ];

        $category = (new CategoryArrayTransformer())->transform($data);

        self::assertInstanceOf(Category::class, $category);

        self::assertEquals($data['id'], $category->getId());
        self::assertEquals($data['parent_id'], $category->getParentId());
        self::assertEquals($data['title'], $category->getTitle());
        self::assertEquals($data['description'], $category->getDescription());
        self::assertEquals($data['link'], $category->getLink());
        self::assertEquals($data['slug'], $category->getSlug());
        self::assertEquals($data['shops_count'], $category->getShopsCount());
    }
}

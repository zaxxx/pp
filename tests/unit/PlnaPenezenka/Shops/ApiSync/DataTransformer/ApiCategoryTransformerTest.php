<?php
declare(strict_types=1);

namespace Tests\Unit\PlnaPenezenka\Shops\ApiSync\DataTransformer;

use PHPUnit\Framework\TestCase;
use PlnaPenezenka\Api\Shops\Category;
use PlnaPenezenka\Shops\ApiSync\DataTransformer\ApiCategoryTransformer;
use PlnaPenezenka\Shops\Repository\CategoryRepository;

class ApiCategoryTransformerTest extends TestCase
{
    public function testTransformerCreatesEntity(): void
    {
        $categoryRepository = $this->createMock(CategoryRepository::class);
        $categoryRepository->expects(self::exactly(2))
            ->method('getByPpApiId')
            ->willReturn(null);

        $apiCategory = new Category();
        $apiCategory->setId(123);
        $apiCategory->setParentId(111);
        $apiCategory->setTitle('abc');
        $apiCategory->setDescription('xyz');
        $apiCategory->setLink('https://google.com');
        $apiCategory->setSlug('abc');
        $apiCategory->setShopsCount(1);

        $transformer = new ApiCategoryTransformer($categoryRepository);
        $category = $transformer->transform($apiCategory);

        self::assertEquals($apiCategory->getId(), $category->getPpApiId());
        self::assertEquals($apiCategory->getTitle(), $category->getTitle());
        self::assertEquals($apiCategory->getDescription(), $category->getDescription());
        self::assertEquals($apiCategory->getLink(), $category->getLink());
        self::assertEquals($apiCategory->getSlug(), $category->getSlug());
        self::assertEquals($apiCategory->getShopsCount(), $category->getShopsCount());
    }
}

<?php
declare(strict_types=1);

namespace Tests\Unit\PlnaPenezenka\Shops\ApiSync\DataTransformer;

use PHPUnit\Framework\TestCase;
use PlnaPenezenka\Api\Shops\Shop;
use PlnaPenezenka\Shops\ApiSync\DataTransformer\ApiShopTransformer;
use PlnaPenezenka\Shops\Repository\CategoryRepository;
use PlnaPenezenka\Shops\Repository\ShopRepository;

class ApiShopTransformerTest extends TestCase
{
    public function testTransformerCreatesEntity(): void
    {
        $shopRepository = $this->createMock(ShopRepository::class);
        $shopRepository->expects(self::once())
            ->method('getByPpApiId')
            ->willReturn(null);

        $categoryRepository = $this->createMock(CategoryRepository::class);
        $categoryRepository->expects(self::once())
            ->method('getByPpApiId')
            ->willReturn(null);

        $apiShop = new Shop();
        $apiShop->setId(123);
        $apiShop->setCategoryId(123);
        $apiShop->setName('abc');
        $apiShop->setTitle('xyz');
        $apiShop->setDescription('foo');
        $apiShop->setImageUrl('https://google.com/img.jpg');
        $apiShop->setLink('https://google.com');
        $apiShop->setSlug('abc');
        $apiShop->setIsFavorite(true);
        $apiShop->setCreatedAt(new \DateTimeImmutable());
        $apiShop->setPopularity(1.1);

        $transformer = new ApiShopTransformer($shopRepository, $categoryRepository);
        $shop = $transformer->transform($apiShop);

        self::assertEquals($apiShop->getId(), $shop->getPpApiId());
        self::assertEquals($apiShop->getName(), $shop->getName());
        self::assertEquals($apiShop->getTitle(), $shop->getTitle());
        self::assertEquals($apiShop->getDescription(), $shop->getDescription());
        self::assertEquals($apiShop->getImageUrl(), $shop->getImageUrl());
        self::assertEquals($apiShop->getLink(), $shop->getLink());
        self::assertEquals($apiShop->getSlug(), $shop->getSlug());
        self::assertEquals($apiShop->isFavorite(), $shop->isFavorite());
        self::assertEquals($apiShop->getCreatedAt(), $shop->getCreatedAt());
        self::assertEquals($apiShop->getPopularity(), $shop->getPopularity());
    }
}

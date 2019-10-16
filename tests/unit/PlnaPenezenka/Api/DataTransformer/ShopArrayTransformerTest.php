<?php
declare(strict_types=1);

namespace Tests\Unit\PlnaPenezenka\Api\DataTransformer;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use PlnaPenezenka\Api\DataTransformer\ShopArrayTransformer;
use PlnaPenezenka\Api\Shops\Shop;

class ShopArrayTransformerTest extends TestCase
{
    public function testTransformerCreatesShop(): void
    {
        $data = [
            'id' => 1,
            'category_id' => 2,
            'name' => 'foo',
            'title' => 'bar',
            'description' => 'baz',
            'image_url' => 'abc.jpg',
            'link' => 'https://google.com',
            'slug' => 'foo',
            'is_favorite' => false,
            'created_at' => '2016-02-12T15:35:57+01:00',
            'popularity' => 1.23,
        ];

        $shop = (new ShopArrayTransformer())->transform($data);

        self::assertInstanceOf(Shop::class, $shop);

        self::assertEquals($data['id'], $shop->getId());
        self::assertEquals($data['category_id'], $shop->getCategoryId());
        self::assertEquals($data['name'], $shop->getName());
        self::assertEquals($data['title'], $shop->getTitle());
        self::assertEquals($data['description'], $shop->getDescription());
        self::assertEquals($data['image_url'], $shop->getImageUrl());
        self::assertEquals($data['link'], $shop->getLink());
        self::assertEquals($data['slug'], $shop->getSlug());
        self::assertEquals($data['is_favorite'], $shop->isFavorite());
        self::assertEquals(new DateTimeImmutable($data['created_at']), $shop->getCreatedAt());
        self::assertEquals($data['popularity'], $shop->getPopularity());
    }
}

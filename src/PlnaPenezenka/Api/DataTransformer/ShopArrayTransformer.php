<?php
declare(strict_types=1);

namespace PlnaPenezenka\Api\DataTransformer;

use DateTimeImmutable;
use PlnaPenezenka\Api\Shops\Shop;

class ShopArrayTransformer
{
    public function transform(array $data): Shop
    {
        $shop = new Shop();
        $shop->setId($data['id']);
        $shop->setCategoryId($data['category_id']);
        $shop->setName($data['name']);
        $shop->setTitle($data['title']);
        $shop->setDescription($data['description']);
        $shop->setImageUrl($data['image_url']);
        $shop->setLink($data['link']);
        $shop->setSlug($data['slug']);
        $shop->setIsFavorite($data['is_favorite']);
        $shop->setCreatedAt(new DateTimeImmutable($data['created_at']));
        $shop->setPopularity($data['popularity']);

        return $shop;
    }
}

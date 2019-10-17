<?php
declare(strict_types=1);

namespace PlnaPenezenka\Shops\ApiSync\DataTransformer;

use PlnaPenezenka\Api\Shops\Shop as ApiShop;
use PlnaPenezenka\Shops\Repository\CategoryRepository;
use PlnaPenezenka\Shops\Repository\ShopRepository;
use PlnaPenezenka\Shops\Shop;

class ApiShopTransformer
{
    /** @var ShopRepository */
    private $shopRepository;

    /** @var CategoryRepository */
    private $categoryRepository;

    public function __construct(ShopRepository $shopRepository, CategoryRepository $categoryRepository)
    {
        $this->shopRepository = $shopRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function transform(ApiShop $apiShop): Shop
    {
        $shop = $this->shopRepository->getByPpApiId($apiShop->getId()) ?? new Shop();

        $category = null;
        if ($apiShop->getCategoryId() !== null) {
            $category = $this->categoryRepository->getByPpApiId($apiShop->getCategoryId());
        }

        $shop->setCategory($category);
        $shop->setPpApiId($apiShop->getId());
        $shop->setName($apiShop->getName());
        $shop->setTitle($apiShop->getTitle());
        $shop->setDescription($apiShop->getDescription());
        $shop->setImageUrl($apiShop->getImageUrl());
        $shop->setLink($apiShop->getLink());
        $shop->setSlug($apiShop->getSlug());
        $shop->setIsFavorite($apiShop->isFavorite());
        $shop->setCreatedAt($apiShop->getCreatedAt());
        $shop->setPopularity($apiShop->getPopularity());

        return $shop;
    }
}

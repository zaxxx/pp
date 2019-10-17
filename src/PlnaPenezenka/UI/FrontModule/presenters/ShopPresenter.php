<?php
declare(strict_types=1);

namespace PlnaPenezenka\UI\FrontModule;

use Nette\Application\BadRequestException;
use Nette\Application\UI\Presenter;
use PlnaPenezenka\Shops\Repository\ShopRepository;
use PlnaPenezenka\Shops\Shop;

class ShopPresenter extends Presenter
{
    /** @var ShopRepository */
    private $repository;

    public function __construct(ShopRepository $repository)
    {
        $this->repository = $repository;
    }

    public function actionDefault(string $shop): void
    {
        $shopEntity = $this->repository->getBySlug($shop);

        if ($shopEntity === null) {
            throw new BadRequestException('Shop not found.');
        }

        $this->template->shop = $this->transformShop($shopEntity);
    }

    private function transformShop(Shop $shop): array
    {
        return [
            'id' => $shop->getId(),
            'slug' => $shop->getSlug(),
            'name' => $shop->getName(),
            'category' => $shop->getCategory() === null ? null : $shop->getCategory()->getTitle(),
            'description' => $shop->getDescription(),
            'link' => $shop->getLink(),
            'image_url' => $shop->getImageUrl(),
            'popularity' => $shop->getPopularity(),
        ];
    }
}

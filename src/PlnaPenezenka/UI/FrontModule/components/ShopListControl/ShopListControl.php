<?php
declare(strict_types=1);

namespace PlnaPenezenka\UI\FrontModule\Components;

use Nette\Application\UI\Control;
use PlnaPenezenka\Shops\Shop;

class ShopListControl extends Control
{
    /** @var Shop[] */
    private $shops;

    public function __construct(array $shops = [])
    {
        $this->shops = $shops;
    }

    public function render(): void
    {
        $this->template->setFile(__DIR__ . '/default.latte');
        $this->template->shops = $this->transformShops($this->shops);
        $this->template->render();
    }

    /**
     * @param Shop[] $shops
     * @return array
     */
    private function transformShops(array $shops): array
    {
        return array_map(function (Shop $shop) {
            return [
                'id' => $shop->getId(),
                'slug' => $shop->getSlug(),
                'name' => $shop->getName(),
                'category' => $shop->getCategory() === null ? null : $shop->getCategory()->getTitle(),
                'link' => $shop->getLink(),
                'image_url' => $shop->getImageUrl(),
                'popularity' => $shop->getPopularity(),
            ];
        }, $shops);
    }
}

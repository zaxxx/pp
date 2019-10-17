<?php
declare(strict_types=1);

namespace PlnaPenezenka\UI\FrontModule;

use Nette\Application\UI\Presenter;
use PlnaPenezenka\Shops\Repository\ShopRepository;
use PlnaPenezenka\UI\FrontModule\Components\PaginatorControl;
use PlnaPenezenka\UI\FrontModule\Components\ShopListControl;

class DefaultPresenter extends Presenter
{
    private const LIMIT = 10;

    /** @var ShopRepository */
    private $repository;

    public function __construct(ShopRepository $repository)
    {
        $this->repository = $repository;
    }

    public function actionDefault(int $page = 1): void
    {
        if ($this->isAjax()) {
            $this->redrawControl('list');
        }

        $shops = $this->repository->paginate(max($page - 1, 0), self::LIMIT);

        $this->addComponent(new ShopListControl($shops), 'shopList');
        $this->addComponent($this->createPaginatorControl($page), 'paginator');
    }

    private function createPaginatorControl(int $page): PaginatorControl
    {
        $linkGenerator = function (int $page) {
            return $this->link('this', ['page' => $page]);
        };

        return new PaginatorControl(self::LIMIT, $page, $this->repository->countShops(), $linkGenerator);
    }
}

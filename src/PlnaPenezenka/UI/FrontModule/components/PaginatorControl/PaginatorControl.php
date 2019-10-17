<?php
declare(strict_types=1);

namespace PlnaPenezenka\UI\FrontModule\Components;

use Nette\Application\UI\Control;

class PaginatorControl extends Control
{
    /** @var int */
    private $limit;

    /** @var int */
    private $page;

    /** @var int */
    private $total;

    /** @var callable */
    private $linkGenerator;

    public function __construct(int $limit, int $page, int $total, callable $linkGenerator)
    {
        $this->limit = $limit;
        $this->page = $page;
        $this->total = $total;
        $this->linkGenerator = $linkGenerator;
    }

    public function render(): void
    {
        $this->template->setFile(__DIR__ . '/default.latte');
        $this->template->pageCount = ceil($this->total / $this->limit);
        $this->template->page = $this->page;
        $this->template->linkGenerator = $this->linkGenerator;
        $this->template->render();
    }
}

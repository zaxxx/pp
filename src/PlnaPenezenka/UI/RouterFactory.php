<?php
declare(strict_types=1);

namespace PlnaPenezenka\UI;

use Nette\Application\Routers\RouteList;

class RouterFactory
{
    /** @var string */
    private $prefix;

    public function __construct(string $prefix = '')
    {
        $this->prefix = $prefix;
    }

    public function create(): RouteList
    {
        $router = new RouteList();

        $router->addRoute($this->prefix . '/[<page \d+>]', [
            'module' => 'Front',
            'presenter' => 'Default',
            'action' => 'default',
            'page' => 1,
        ]);

        $router->addRoute($this->prefix . '/<shop>', [
            'module' => 'Front',
            'presenter' => 'Shop',
            'action' => 'default',
        ]);

        return $router;
    }
}

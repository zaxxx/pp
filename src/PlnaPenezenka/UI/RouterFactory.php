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

        $router->addRoute($this->prefix . '/obchod/<shop>', [
            'presenter' => 'Front:Shop',
            'action' => 'default',
        ]);

        $router->addRoute($this->prefix . '/[<page \d+>]', [
            'presenter' => 'Front:Default',
            'action' => 'default',
            'page' => 1,
        ]);

        return $router;
    }
}

<?php
declare(strict_types=1);

use Nette\Application\Application;
use Nette\Application\IPresenterFactory;
use Nette\Bridges\ApplicationTracy\RoutingPanel;
use Nette\DI\Compiler;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;
use Nette\DI\Extensions\ExtensionsExtension;
use Nette\Http\IRequest;
use Nette\Routing\Router;
use Symfony\Component\Console\Application as ConsoleApplication;
use Tracy\Debugger;

$devMode = file_exists(__DIR__ . '/config/dev.neon');

Debugger::enable(!$devMode, __DIR__ . '/../temp/log');
Debugger::$strictMode = true;

$containerLoader = new ContainerLoader(__DIR__ . '/../temp/cache', $devMode);
$class = $containerLoader->load(function (Compiler $compiler) use ($devMode) {
    $compiler->addExtension('extensions', new ExtensionsExtension());
    $compiler->loadConfig(__DIR__ . '/config/config.neon');
    $compiler->addConfig([
        'parameters' => [
            'devMode' => $devMode,
            'srcDir' => __DIR__,
        ],
    ]);
}, 'container');

/** @var Container $container */
$container = new $class();

Debugger::getBar()->addPanel(new RoutingPanel(
    $container->getByType(Router::class),
    $container->getByType(IRequest::class),
    $container->getByType(IPresenterFactory::class))
);

if (php_sapi_name() === 'cli') {
    $container->getByType(ConsoleApplication::class)->run();
} else {
    $container->getByType(Application::class)->run();
}

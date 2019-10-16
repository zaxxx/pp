<?php
declare(strict_types=1);

use Nette\Application\Application;
use Nette\DI\Compiler;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;
use Symfony\Component\Console\Application as ConsoleApplication;
use Tracy\Debugger;

$devMode = file_exists(__DIR__ . '/config/dev.neon');

Debugger::enable(!$devMode, __DIR__ . '/../temp/log');
Debugger::$strictMode = true;

$containerLoader = new ContainerLoader(__DIR__ . '/../temp/cache', $devMode);
$class = $containerLoader->load(function (Compiler $compiler) use ($devMode) {
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

if (php_sapi_name() === 'cli') {
    $container->getByType(ConsoleApplication::class)->run();
} else {
    $container->getByType(Application::class)->run();
}

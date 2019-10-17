<?php
declare(strict_types=1);

use Nette\Application\Application;
use Nette\Configurator;
use Nette\DI\Container;
use Symfony\Component\Console\Application as ConsoleApplication;
use Tracy\Debugger;

$devMode = file_exists(__DIR__ . '/config/dev.neon');

Debugger::$strictMode = true;

$configurator = new Configurator();
$configurator->addConfig(__DIR__ . '/config/config.neon');
$configurator->addConfig(__DIR__ . '/config/config.local.neon');
$configurator->setTempDirectory(__DIR__ . '/../temp/cache');
$configurator->setDebugMode($devMode);
$configurator->enableTracy(__DIR__ . '/../temp/log');
$configurator->addParameters([
    'devMode' => $devMode,
    'srcDir' => __DIR__,
]);

/** @var Container $container */
$container = $configurator->createContainer();

if (php_sapi_name() === 'cli') {
    $container->getByType(ConsoleApplication::class)->run();
} else {
    $container->getByType(Application::class)->run();
}

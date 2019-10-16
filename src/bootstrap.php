<?php
declare(strict_types=1);

use Nette\DI\Compiler;
use Nette\DI\Config\Loader;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;
use Tracy\Debugger;

$configFile = __DIR__ . '/config/config.neon';
$configLoader = new Loader();
$config = $configLoader->load($configFile, false);

$devMode = $config['devMode'] ?? false;

Debugger::enable(!$devMode, __DIR__ . '/../temp/log');

$containerLoader = new ContainerLoader(__DIR__ . '/../temp/cache', $devMode);
$class = $containerLoader->load(function (Compiler $compiler) use ($configFile, $configLoader) {
    $compiler->loadConfig($configFile, $configLoader);
}, 'container');

/** @var Container $container */
$container = new $class();

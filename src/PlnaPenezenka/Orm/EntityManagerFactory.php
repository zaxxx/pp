<?php
declare(strict_types=1);

namespace PlnaPenezenka\Orm;

use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;
use PDO;

class EntityManagerFactory
{
    /** @var string[] */
    private $paths;

    /** @var string */
    private $proxyDir;

    /** @var bool */
    private $devMode;

    /** @var PDO */
    private $pdo;

    public function __construct(array $paths, string $proxyDir, bool $devMode, PDO $pdo)
    {
        $this->paths = $paths;
        $this->proxyDir = $proxyDir;
        $this->devMode = $devMode;
        $this->pdo = $pdo;
    }

    /**
     * @return EntityManagerInterface
     * @throws ORMException
     */
    public function create(): EntityManagerInterface
    {
        return EntityManager::create([
            'driver' => 'pdo_mysql',
            'pdo' => $this->pdo,
        ], $this->createConfiguration());
    }

    private function createConfiguration(): Configuration
    {
        return Setup::createAnnotationMetadataConfiguration($this->paths, $this->devMode, $this->proxyDir, null, false);
    }
}

<?php
declare(strict_types=1);

namespace PlnaPenezenka\Shops\ApiSync\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use PlnaPenezenka\Shops\Category;
use PlnaPenezenka\Shops\Shop;
use PlnaPenezenka\Shops\ApiSync\ApiSyncStorage;

class DoctrineApiSyncStorage implements ApiSyncStorage
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function saveCategory(Category $category): void
    {
        $this->entityManager->persist($category);
    }

    public function saveShop(Shop $shop): void
    {
        $this->entityManager->persist($shop);
    }

    public function flush(): void
    {
        $this->entityManager->flush();
    }
}

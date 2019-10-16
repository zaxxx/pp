<?php
declare(strict_types=1);

namespace PlnaPenezenka\Shops\Repository\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use PlnaPenezenka\Shops\Category;
use PlnaPenezenka\Shops\Repository\CategoryRepository;

class DoctrineCategoryRepository implements CategoryRepository
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getById(int $id): ?Category
    {
        $entity = $this->entityManager->find(Category::class, $id);

        if ($entity instanceof Category) {
            return $entity;
        }

        return null;
    }

    public function getByPpApiId(int $ppApiId): ?Category
    {
        $entity = $this->entityManager->getRepository(Category::class)->findOneBy([
            'ppApiId' => $ppApiId,
        ]);

        if ($entity instanceof Category) {
            return $entity;
        }

        return null;
    }
}

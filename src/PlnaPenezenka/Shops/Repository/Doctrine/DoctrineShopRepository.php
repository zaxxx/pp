<?php
declare(strict_types=1);

namespace PlnaPenezenka\Shops\Repository\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use PlnaPenezenka\Shops\Repository\ShopRepository;
use PlnaPenezenka\Shops\Shop;

class DoctrineShopRepository implements ShopRepository
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getById(int $id): ?Shop
    {
        $entity = $this->entityManager->find(Shop::class, $id);

        if ($entity instanceof Shop) {
            return $entity;
        }

        return null;
    }

    public function getByPpApiId(int $ppApiId): ?Shop
    {
        $entity = $this->entityManager->getRepository(Shop::class)->findOneBy([
            'ppApiId' => $ppApiId,
        ]);

        if ($entity instanceof Shop) {
            return $entity;
        }

        return null;
    }

    public function getBySlug(string $slug): ?Shop
    {
        $entity = $this->entityManager->getRepository(Shop::class)->findOneBy([
            'slug' => $slug,
        ]);

        if ($entity instanceof Shop) {
            return $entity;
        }

        return null;
    }

    public function paginate(int $page, int $limit): array
    {
        return $this->entityManager->getRepository(Shop::class)
            ->findBy([], null, $limit, $page * $limit);
    }

    public function countShops(): int
    {
        $builder = $this->entityManager->createQueryBuilder()
            ->select('COUNT(s.id) AS count_shops')
            ->from(Shop::class, 's');

        return (int)$builder->getQuery()->getSingleScalarResult();
    }
}

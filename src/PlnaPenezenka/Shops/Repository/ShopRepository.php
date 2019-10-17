<?php
declare(strict_types=1);

namespace PlnaPenezenka\Shops\Repository;

use PlnaPenezenka\Shops\Shop;

interface ShopRepository
{
    public function getById(int $id): ?Shop;

    public function getByPpApiId(int $ppApiId): ?Shop;

    public function getBySlug(string $slug): ?Shop;

    /**
     * @param int $page
     * @param int $limit
     * @return Shop[]
     */
    public function paginate(int $page, int $limit): array;

    public function countShops(): int;
}

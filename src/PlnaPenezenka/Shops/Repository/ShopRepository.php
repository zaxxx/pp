<?php
declare(strict_types=1);

namespace PlnaPenezenka\Shops\Repository;

use PlnaPenezenka\Shops\Shop;

interface ShopRepository
{
    public function getById(int $id): ?Shop;

    public function getByPpApiId(int $ppApiId): ?Shop;
}

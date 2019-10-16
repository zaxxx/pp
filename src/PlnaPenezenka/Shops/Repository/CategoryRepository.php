<?php
declare(strict_types=1);

namespace PlnaPenezenka\Shops\Repository;

use PlnaPenezenka\Shops\Category;

interface CategoryRepository
{
    public function getById(int $id): ?Category;

    public function getByPpApiId(int $ppApiId): ?Category;
}

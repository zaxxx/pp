<?php
declare(strict_types=1);

namespace PlnaPenezenka\Shops\ApiSync;

use PlnaPenezenka\Shops\Category;
use PlnaPenezenka\Shops\Shop;

interface ApiSyncStorage
{
    public function saveCategory(Category $category): void;

    public function saveShop(Shop $shop): void;

    public function flush(): void;
}

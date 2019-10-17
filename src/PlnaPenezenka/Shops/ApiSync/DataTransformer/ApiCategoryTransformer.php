<?php
declare(strict_types=1);

namespace PlnaPenezenka\Shops\ApiSync\DataTransformer;

use PlnaPenezenka\Api\Shops\Category as ApiCategory;
use PlnaPenezenka\Shops\Category;
use PlnaPenezenka\Shops\Repository\CategoryRepository;

class ApiCategoryTransformer
{
    /** @var CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function transform(ApiCategory $apiCategory): Category
    {
        $category = $this->categoryRepository->getByPpApiId($apiCategory->getId()) ?? new Category();

        if ($apiCategory->getParentId() !== null) {
            $category->setParent($this->categoryRepository->getByPpApiId($apiCategory->getParentId()));
        }
        $category->setPpApiId($apiCategory->getId());
        $category->setTitle($apiCategory->getTitle());
        $category->setDescription($apiCategory->getDescription());
        $category->setLink($apiCategory->getLink());
        $category->setSlug($apiCategory->getSlug());
        $category->setShopsCount($apiCategory->getShopsCount());

        return $category;
    }
}

<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogCategory\Plugin\ModifyRepository;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Api\Data\CategoryInterface;

class OnCategoryRepository
{
    public function __construct(
        private readonly State $state
    )
    {
    }

    public function aroundGet(
        CategoryRepositoryInterface $categoryRepository,
        callable                    $proceed,
                                    $categoryId,
                                    $storeId = null
    ): CategoryInterface
    {
        $category = $this->state->getCategory();

        if ($category && null === $storeId) {
            $storeId = (int)$category->getStoreId();
        }

        return $proceed($categoryId, $storeId);
    }
}

<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogCategory\Plugin\ModifyRepository;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Api\Data\CategoryInterface;

class OnCategoryRepository
{
    private State $state;

    public function __construct(
        State $state
    )
    {
        $this->state = $state;
    }

    public function aroundGet(
        CategoryRepositoryInterface $categoryRepository,
        callable $proceed,
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

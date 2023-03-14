<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogCategory\Model\Command;

use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\ResourceModel\Category as CategoryResource;
use MateuszMesek\DocumentDataApi\Model\Data\DocumentDataInterface;

class GetDocumentDataByCategoryIdAndStoreId
{
    public function __construct(
        private readonly CategoryResource $categoryResource,
        private readonly CategoryFactory  $categoryFactory,
        private readonly GetDocumentData  $getDocumentData
    )
    {
    }

    public function execute(int $categoryId, int $storeId): ?DocumentDataInterface
    {
        $category = $this->categoryFactory->create();
        $category->setStoreId($storeId);

        $this->categoryResource->load($category, $categoryId);

        if (!$this->isCategoryAvailableInStore($category)) {
            return null;
        }

        return $this->getDocumentData->execute($category);
    }

    private function isCategoryAvailableInStore(Category $category): bool
    {
        $store = $category->getStore();

        $rootCategoryId = (int)$store->getRootCategoryId();

        $allowedCategoryIds = array_map('intval', $category->getParentIds());
        $allowedCategoryIds[] = (int)$category->getId();

        return in_array($rootCategoryId, $allowedCategoryIds, true);
    }
}

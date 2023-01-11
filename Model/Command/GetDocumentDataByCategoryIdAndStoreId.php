<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogCategory\Model\Command;

use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\ResourceModel\Category as CategoryResource;
use MateuszMesek\DocumentDataApi\Model\Data\DocumentDataInterface;
use MateuszMesek\DocumentDataCatalogCategory\Model\Command\GetDocumentData;

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

        return $this->getDocumentData->execute($category);
    }
}

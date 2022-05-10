<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogCategory\Command;

use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\ResourceModel\Category as CategoryResource;
use MateuszMesek\DocumentDataApi\Data\DocumentDataInterface;

class GetDocumentDataByCategoryIdAndStoreId
{
    private CategoryResource $categoryResource;
    private CategoryFactory $categoryFactory;
    private GetDocumentData $getDocumentData;

    public function __construct(
        CategoryResource $categoryResource,
        CategoryFactory  $categoryFactory,
        GetDocumentData  $getDocumentData
    )
    {
        $this->categoryResource = $categoryResource;
        $this->categoryFactory = $categoryFactory;
        $this->getDocumentData = $getDocumentData;
    }

    public function execute(int $categoryId, int $storeId): ?DocumentDataInterface
    {
        $category = $this->categoryFactory->create();
        $category->setStoreId($storeId);

        $this->categoryResource->load($category, $categoryId);

        return $this->getDocumentData->execute($category);
    }
}

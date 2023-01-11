<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogCategory\Plugin\ModifyRepository;

use Magento\Catalog\Api\Data\CategoryInterface;
use MateuszMesek\DocumentDataApi\Model\Data\DocumentDataInterface;
use MateuszMesek\DocumentDataCatalogCategory\Model\Command\GetDocumentData;

class OnGetDocumentData
{
    public function __construct(
        private readonly State $state
    )
    {
    }

    public function aroundExecute(
        GetDocumentData   $getDocumentData,
        callable          $proceed,
        CategoryInterface $category
    ): ?DocumentDataInterface
    {
        try {
            $this->state->setCategory($category);

            return $proceed($category);
        } finally {
            $this->state->unsetCategory();
        }
    }
}

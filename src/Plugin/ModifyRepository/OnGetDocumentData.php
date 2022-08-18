<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogCategory\Plugin\ModifyRepository;

use Magento\Catalog\Api\Data\CategoryInterface;
use MateuszMesek\DocumentDataApi\Data\DocumentDataInterface;
use MateuszMesek\DocumentDataCatalogCategory\Command\GetDocumentData;

class OnGetDocumentData
{
    private State $state;

    public function __construct(
        State $state
    )
    {
        $this->state = $state;
    }

    public function aroundExecute(
        GetDocumentData $getDocumentData,
        callable $proceed,
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

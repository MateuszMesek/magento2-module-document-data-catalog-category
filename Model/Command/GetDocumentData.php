<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogCategory\Model\Command;

use Magento\Catalog\Api\Data\CategoryInterface;
use Magento\Catalog\Model\Category;
use MateuszMesek\DocumentDataApi\Model\Command\GetDocumentDataInterface;
use MateuszMesek\DocumentDataApi\Model\Data\DocumentDataInterface;
use MateuszMesek\DocumentDataCatalogCategory\Model\Data\InputFactory;

class GetDocumentData
{
    public function __construct(
        private readonly InputFactory             $inputFactory,
        private readonly GetDocumentDataInterface $getDocumentData
    )
    {
    }

    public function execute(CategoryInterface $category): ?DocumentDataInterface
    {
        $input = $this->inputFactory->create(['category' => $category]);

        return $this->getDocumentData->execute(Category::ENTITY, $input);
    }
}

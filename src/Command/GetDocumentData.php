<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogCategory\Command;

use Magento\Catalog\Api\Data\CategoryInterface;
use Magento\Catalog\Model\Category;
use MateuszMesek\DocumentDataApi\Command\GetDocumentDataInterface;
use MateuszMesek\DocumentDataCatalogCategory\Data\InputFactory;

class GetDocumentData
{
    private InputFactory $inputFactory;
    private GetDocumentDataInterface $getDocumentData;

    public function __construct(
        InputFactory $inputFactory,
        GetDocumentDataInterface $getDocumentData
    )
    {
        $this->inputFactory = $inputFactory;
        $this->getDocumentData = $getDocumentData;
    }

    public function execute(CategoryInterface $category): array
    {
        $input = $this->inputFactory->create(['category' => $category]);

        return $this->getDocumentData->execute(Category::ENTITY, $input);
    }
}

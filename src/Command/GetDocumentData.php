<?php declare(strict_types=1);

namespace MateuszMesek\DocumentCatalogCategory\Command;

use Magento\Catalog\Api\Data\CategoryInterface;
use Magento\Catalog\Model\Category;
use MateuszMesek\Document\Api\Command\GetDocumentDataInterface;
use MateuszMesek\DocumentCatalogCategory\Data\InputFactory;

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

    public function execute(CategoryInterface $category)
    {
        $input = $this->inputFactory->create(['category' => $category]);

        return $this->getDocumentData->execute(Category::ENTITY, $input);
    }
}

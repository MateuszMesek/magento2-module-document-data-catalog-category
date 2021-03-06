<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogCategory\Data;

use Magento\Catalog\Api\Data\CategoryInterface;
use MateuszMesek\DocumentDataApi\InputInterface;

class Input implements InputInterface
{
    private CategoryInterface $category;

    public function __construct(
        CategoryInterface $category
    )
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return (string)$this->category->getId();
    }

    /**
     * @return \Magento\Catalog\Api\Data\CategoryInterface
     */
    public function getCategory(): CategoryInterface
    {
        return $this->category;
    }
}

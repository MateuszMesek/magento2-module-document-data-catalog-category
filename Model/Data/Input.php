<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogCategory\Model\Data;

use Magento\Catalog\Api\Data\CategoryInterface;
use MateuszMesek\DocumentDataApi\Model\InputInterface;

class Input implements InputInterface
{
    public function __construct(
        private readonly CategoryInterface $category
    )
    {
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

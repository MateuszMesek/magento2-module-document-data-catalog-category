<?php declare(strict_types=1);

namespace MateuszMesek\DocumentCatalogCategory\Data;

use Magento\Catalog\Api\Data\CategoryInterface;
use MateuszMesek\Document\Api\InputInterface;

class Input implements InputInterface
{
    private CategoryInterface $category;

    public function __construct(
        CategoryInterface $category
    )
    {
        $this->category = $category;
    }

    public function getCategory(): CategoryInterface
    {
        return $this->category;
    }
}

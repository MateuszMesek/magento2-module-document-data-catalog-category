<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogCategory\Plugin\ModifyRepository;

use Magento\Catalog\Api\Data\CategoryInterface;

class State
{
    private array $level = [];

    public function setCategory(CategoryInterface $category): void
    {
        $this->level[] = $category;
    }

    public function getCategory(): ?CategoryInterface
    {
        $product = current($this->level);

        if (!$product) {
            return null;
        }

        return $product;
    }

    public function unsetCategory(): void
    {
        array_pop($this->level);
    }
}

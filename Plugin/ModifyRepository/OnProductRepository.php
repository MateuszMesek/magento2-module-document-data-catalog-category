<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogCategory\Plugin\ModifyRepository;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;

class OnProductRepository
{
    public function __construct(
        private readonly State $state
    )
    {
    }

    public function aroundGet(
        ProductRepositoryInterface $productRepository,
        callable                   $proceed,
                                   $sku,
                                   $editMode = false,
                                   $storeId = null,
                                   $forceReload = false
    ): ProductInterface
    {
        $category = $this->state->getCategory();

        if ($category && null === $storeId) {
            $storeId = (int)$category->getStoreId();
        }

        return $proceed($sku, $editMode, $storeId, $forceReload);
    }

    public function aroundGetById(
        ProductRepositoryInterface $productRepository,
        callable                   $proceed,
                                   $productId,
                                   $editMode = false,
                                   $storeId = null,
                                   $forceReload = false
    ): ProductInterface
    {
        $category = $this->state->getCategory();

        if ($category && null === $storeId) {
            $storeId = (int)$category->getStoreId();
        }

        return $proceed($productId, $editMode, $storeId, $forceReload);
    }
}

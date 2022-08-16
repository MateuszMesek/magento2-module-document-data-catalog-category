<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogCategory\AttributeValueResolver;

use Magento\Eav\Api\Data\AttributeInterface;
use MateuszMesek\DocumentDataApi\InputInterface;
use MateuszMesek\DocumentDataCatalogCategory\Data\Input;
use MateuszMesek\DocumentDataEavApi\AttributeValueResolverInterface;

class DefaultResolver implements AttributeValueResolverInterface
{
    public function resolver(AttributeInterface $attribute, InputInterface $input)
    {
        if (!$input instanceof Input) {
            return null;
        }

        $category = $input->getCategory();

        $attributeCode = $attribute->getAttributeCode();

        return $category->getDataUsingMethod($attributeCode);
    }
}

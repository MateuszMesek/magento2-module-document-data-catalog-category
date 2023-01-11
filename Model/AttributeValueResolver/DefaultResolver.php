<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogCategory\Model\AttributeValueResolver;

use Magento\Eav\Api\Data\AttributeInterface;
use MateuszMesek\DocumentDataApi\Model\InputInterface;
use MateuszMesek\DocumentDataCatalogCategory\Model\Data\Input;
use MateuszMesek\DocumentDataEavApi\Model\AttributeValueResolverInterface;

class DefaultResolver implements AttributeValueResolverInterface
{
    public function resolver(AttributeInterface $attribute, InputInterface $input): mixed
    {
        if (!$input instanceof Input) {
            return null;
        }

        $category = $input->getCategory();

        $attributeCode = $attribute->getAttributeCode();

        return $category->getDataUsingMethod($attributeCode);
    }
}

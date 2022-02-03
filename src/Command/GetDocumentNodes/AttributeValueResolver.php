<?php declare(strict_types=1);

namespace MateuszMesek\DocumentCatalogCategory\Command\GetDocumentNodes;

use Magento\Catalog\Model\Category;
use Magento\Eav\Api\Data\AttributeInterface;
use MateuszMesek\Document\Api\InputInterface;
use MateuszMesek\DocumentCatalogCategory\Data\Input;
use MateuszMesek\DocumentEavApi\AttributeValueResolverInterface;

class AttributeValueResolver implements AttributeValueResolverInterface
{
    public function resolver(AttributeInterface $attribute, InputInterface $input)
    {
        if (!$input instanceof Input) {
            return null;
        }

        $category = $input->getCategory();

        if (!$category instanceof Category) {
            return null;
        }

        $attributeCode = $attribute->getAttributeCode();

        return $category->getDataUsingMethod($attributeCode);
    }
}

<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogCategory\Plugin\ModifyRepository;

use MateuszMesek\DocumentDataApi\Model\Command\GetDocumentNodeValueInterface;
use MateuszMesek\DocumentDataApi\Model\Data\DocumentNodeInterface;
use MateuszMesek\DocumentDataApi\Model\InputInterface;
use MateuszMesek\DocumentDataCatalogCategory\Model\Data\Input;

class GetDocumentNodeValue
{
    public function __construct(
        private readonly State $state
    )
    {
    }

    public function aroundExecute(
        GetDocumentNodeValueInterface $getDocumentNodeValue,
        callable                      $proceed,
        DocumentNodeInterface         $documentNode,
        InputInterface                $input
    )
    {
        if (!$input instanceof Input) {
            return $proceed($documentNode, $input);
        }

        try {
            $this->state->setCategory($input->getCategory());

            return $proceed($documentNode, $input);
        } finally {
            $this->state->unsetCategory();
        }
    }
}

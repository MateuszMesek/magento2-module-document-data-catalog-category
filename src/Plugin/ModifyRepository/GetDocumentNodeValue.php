<?php declare(strict_types=1);

namespace MateuszMesek\DocumentDataCatalogCategory\Plugin\ModifyRepository;

use MateuszMesek\DocumentDataApi\Command\GetDocumentNodeValueInterface;
use MateuszMesek\DocumentDataApi\Data\DocumentNodeInterface;
use MateuszMesek\DocumentDataApi\InputInterface;
use MateuszMesek\DocumentDataCatalogCategory\Data\Input;

class GetDocumentNodeValue
{
    private State $state;

    public function __construct(
        State $state
    )
    {
        $this->state = $state;
    }

    public function aroundExecute(
        GetDocumentNodeValueInterface $getDocumentNodeValue,
        callable $proceed,
        DocumentNodeInterface $documentNode,
        InputInterface $input
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

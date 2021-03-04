<?php

namespace Desaiah\Preorder\Model;

use Desaiah\Preorder\Api\GetPreorderByIdentifierInterface;
use Desaiah\Preorder\Api\Data\PreorderInterface;
use Desaiah\Preorder\Model\PreorderFactory;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GetBlockByIdentifier
 */
class GetPreorderByIdentifier implements GetPreorderByIdentifierInterface
{
    /**
     * @var PreorderFactory
     */
    private $preorderFactory;

    /**
     * @var ResourceModel\Preorder
     */
    private $preorderResource;

    /**
     * @param preorderFactory $preorderFactory
     * @param ResourceModel\Preorder $preorderResource
     */
    public function __construct(
        PreorderFactory $preorderFactory,
        \Desaiah\Preorder\Model\ResourceModel\Preorder $preorderResource
    ) {
        $this->preorderFactory = $preorderFactory;
        $this->preorderResource = $preorderResource;
    }

    /**
     * @inheritdoc
     */
    public function execute(string $identifier, int $storeId) : PreorderInterface
    {
        $preorder = $this->preorderFactory->create();
        $preorder->setStoreId($storeId);
        $this->preorderResource->load($preorder, $identifier, PreorderInterface::IDENTIFIER);

        if (!$preorder->getId()) {
            throw new NoSuchEntityException(__('The preorder with the "%1" ID doesn\'t exist.', $identifier));
        }

        return $preorder;
    }
}

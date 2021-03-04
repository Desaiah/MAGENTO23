<?php
namespace Desaiah\Preorder\Api;

use Desaiah\Preorder\Api\Data\PreorderInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Command to load the block data by specified identifier
 * @api
 */
interface GetPreorderByIdentifierInterface
{
    /**
     * Load preorder data by given block identifier.
     *
     * @param string $identifier
     * @param int $storeId
     * @throws NoSuchEntityException
     * @return PreorderInterface
     */
    public function execute(string $identifier, int $storeId) : PreorderInterface;
}

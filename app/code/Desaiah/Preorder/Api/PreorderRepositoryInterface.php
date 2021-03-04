<?php

namespace Desaiah\Preorder\Api;

use Desaiah\Preorder\Api\Data\BlockSearchResultsInterface;
use Desaiah\Preorder\Api\Data\PreorderInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Preorder CRUD interface.
 */
interface PreorderRepositoryInterface
{
    /**
     * Save Preorder.
     *
     * @param PreorderInterface $Preorder
     * @return PreorderInterface
     * @throws LocalizedException
     */
    public function save(PreorderInterface $preorder);

    /**
     * Retrieve Preorder.
     *
     * @param int $preorder_id
     * @return PreorderInterface
     * @throws LocalizedException
     */
    public function getById($preorder_id);

    /**
     * Retrieve blocks matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return BlockSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete block.
     *
     * @param PreorderInterface $Preorder
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(Data\PreorderInterface $preorder);

    /**
     * Delete block by ID.
     *
     * @param int $preorder_id
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($preorder_id);
}

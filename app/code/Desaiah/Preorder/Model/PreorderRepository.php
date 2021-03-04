<?php

namespace Desaiah\Preorder\Model;

use Exception;
use Desaiah\Preorder\Api\Data\PreorderInterface;
use Desaiah\Preorder\Api\Data\PreorderInterfaceFactory;
use Desaiah\Preorder\Api\Data\PreorderSearchResultsInterfaceFactory;
use Desaiah\Preorder\Api\PreorderRepositoryInterface;
use Desaiah\Preorder\Model\ResourceModel\Preorder as ResourcePreorder;
use Desaiah\Preorder\Model\ResourceModel\Preorder\CollectionFactory as PreorderCollectionFactory;
use Magento\Cms\Api\Data\BlockSearchResultsInterface;
use Magento\Cms\Model\ResourceModel\Block\Collection;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class BlockRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class PreorderRepository implements PreorderRepositoryInterface
{
    /**
     * @var ResourcePreorder
     */
    protected $resource;

    /**
     * @var PreorderFactory
     */
    protected $preorderFactory;

    /**
     * @var PreorderCollectionFactory
     */
    protected $preorderCollectionFactory;

    /**
     * @var Data\BlockSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var \Api\Data\PreorderInterface
     */
    protected $dataPreorderFactory;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * PreorderRepository constructor.
     * @param ResourcePreorder $resource
     * @param PreorderFactory $preorderFactory
     * @param PreorderInterfaceFactory $dataPreorderFactory
     * @param PreorderCollectionFactory $preorderCollectionFactory
     * @param PreorderSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface|null $collectionProcessor
     */
    public function __construct(
        ResourcePreorder $resource,
        PreorderFactory $preorderFactory,
        PreorderInterfaceFactory $dataPreorderFactory,
        PreorderCollectionFactory $preorderCollectionFactory,
        PreorderSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor = null
    ) {
        $this->resource = $resource;
        $this->preorderFactory = $preorderFactory;
        $this->dataPreorderFactory = $dataPreorderFactory;
        $this->preorderCollectionFactory = $preorderCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor ?: $this->getCollectionProcessor();
    }

    /**
     * @param PreorderInterface $preorder
     * @return PreorderInterface
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function save(PreorderInterface $preorder)
    {
        if (empty($preorder->getStoreId())) {
            $preorder->setStoreId($this->storeManager->getStore()->getId());
        }

        try {
            $this->resource->save($preorder);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $preorder;
    }

    /**
     * Load Block data by given Block Identity
     *
     * @param string $preorderId
     * @return Block
     * @throws NoSuchEntityException
     */
    public function getById($preorderId)
    {
        $preorder = $this->preorderFactory->create();
        $this->resource->load($preorder, $preorderId);
        if (!$preorder->getId()) {
            throw new NoSuchEntityException(__('The preorder with the "%1" ID doesn\'t exist.', $preorderId));
        }
        return $preorder;
    }

    /**
     * Load Block data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param SearchCriteriaInterface $criteria
     * @return BlockSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        /** @var Collection $collection */
        $collection = $this->preorderCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        /** @var Data\BlockSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Delete Block
     *
     * @param PreorderInterface $preorder
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(PreorderInterface $preorder)
    {
        try {
            $this->resource->delete($preorder);
        } catch (Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete Preorder by given Preorder Identity
     *
     * @param string $preorderId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($preorderId)
    {
        return $this->delete($this->getById($preorderId));
    }
}

<?php
namespace Desaiah\Preorder\Block;

use Desaiah\Preorder\Helper\Data;
use Desaiah\Preorder\Model\ResourceModel\Preorder\Collection;
use Desaiah\Preorder\Model\ResourceModel\Preorder\CollectionFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Preorder
 * @package Desaiah\Preorder\Block
 */
class Preorder extends AbstractBlock
{
    /**
     * @var CollectionFactory
     */
    protected $preorderCollectionFactory;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var Data
     */
    protected $dataHelper;

    /**
     * Preorder constructor.
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param Registry $registry
     * @param CollectionFactory $preorderCollectionFactory
     * @param Data $dataHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        Registry $registry,
        CollectionFactory $preorderCollectionFactory,
        Data $dataHelper,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->registry = $registry;
        $this->preorderCollectionFactory = $preorderCollectionFactory;
        $this->dataHelper = $dataHelper;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('preorder/index/post/', ['_secure' => true]);
    }

    /**
     * @return mixed
     */
    public function getCurrentProductSku()
    {
        $product = $this->registry->registry('current_product');
        return $product->getSku();
    }

    /**
     * @return Collection
     */
    public function getPreorderCollection()
    {
        $questionDisplayCount = $this->dataHelper->getQuestionCount();

        $collection = $this->preorderCollectionFactory->create();
        $collection->addFieldToFilter('sku', $this->getCurrentProductSku());
        $collection->addFieldToFilter('display_front', '1');
        $collection->setPageSize($questionDisplayCount);
        return $collection;
    }

    /**
     * @return mixed
     */
    public function getQuestionDisplaySetting()
    {
        return $this->dataHelper->getQuestionDisplaySetting();
    }
}

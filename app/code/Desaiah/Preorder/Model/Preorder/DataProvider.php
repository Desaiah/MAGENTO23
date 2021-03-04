<?php

namespace Desaiah\Preorder\Model\Preorder;

use Desaiah\Preorder\Model\Preorder;
use Desaiah\Preorder\Model\ResourceModel\Preorder\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;

/**
 * Class DataProvider
 */
class DataProvider extends ModifierPoolDataProvider
{
    /**
     * @var CollectionFactory
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $preorderCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $preorderCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        $this->collection = $preorderCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var Preorder $preorder */
        foreach ($items as $preorder) {
            $this->loadedData[$preorder->getId()] = $preorder->getData();
        }

        $data = $this->dataPersistor->get('desaiah_preorder');
        if (!empty($data)) {
            $preorder = $this->collection->getNewEmptyItem();
            $preorder->setData($data);
            $this->loadedData[$preorder->getId()] = $preorder->getData();
            $this->dataPersistor->clear('desaiah_preorder');
        }

        return $this->loadedData;
    }
}

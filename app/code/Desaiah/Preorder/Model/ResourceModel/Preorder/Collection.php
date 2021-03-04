<?php

namespace Desaiah\Preorder\Model\ResourceModel\Preorder;

use Desaiah\Preorder\Model\Preorder;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected $_idFieldName = Preorder::PREORDER_ID;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Desaiah\Preorder\Model\Preorder', 'Desaiah\Preorder\Model\ResourceModel\Preorder');
    }
}

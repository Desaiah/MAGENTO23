<?php
namespace Smartcode\Dbcollection\Model\ResourceModel\Listview;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Smartcode\Dbcollection\Model\Listview',
            'Smartcode\Dbcollection\Model\ResourceModel\Listview'
        );
    }
}
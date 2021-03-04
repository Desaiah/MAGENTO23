<?php
namespace Smartcode\Dbcollection\Model\ResourceModel;
class Listview extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('grid_collection', 'id');   //here "vky_test" is table name and "test_id" is the primary key of custom table
    }
}
<?php
namespace  Desaiah\Preorder\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Preorder post mysql resource
 */
class Preorder extends AbstractDb
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        // Table Name and Primary Key column
        $this->_init('desaiah_preorder', 'preorder_id');
    }
}

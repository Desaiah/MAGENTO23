<?php
namespace Smartcode\Dbcollection\Model;
use Magento\Framework\Model\AbstractModel;
class Listview extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Smartcode\Dbcollection\Model\ResourceModel\Listview');
    }
}
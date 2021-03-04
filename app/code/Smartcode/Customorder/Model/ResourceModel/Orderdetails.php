<?php
namespace Smartcode\Customorder\Model\ResourceModel;

/**
 * 
 */
class Orderdetails extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	
	protected function _construct()
	{
		$this->_init('sales_order','entity_id');
	}
}
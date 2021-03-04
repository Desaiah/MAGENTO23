<?php
namespace Smartcode\Customorder\Model\ResourceModel\Orderdetails;

/**
 * 
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	
	protected function _construct()
	{
		$this->_init('Smartcode\Customorder\Model\Orderdetails','Smartcode\Customorder\Model\ResourceModel\Orderdetails');
	}
}
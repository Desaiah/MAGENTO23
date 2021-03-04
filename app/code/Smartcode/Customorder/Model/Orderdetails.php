<?php
namespace Smartcode\Customorder\Model;
use \Magento\Framework\Model\AbstractModel;

/**
 * 
 */
class Orderdetails extends AbstractModel
{
	
	protected function _construct()
	{
		$this->_init('Smartcode\Customorder\Model\ResourceModel\Orderdetails');
	}
}
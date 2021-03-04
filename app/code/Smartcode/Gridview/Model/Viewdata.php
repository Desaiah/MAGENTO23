<?php
namespace Smartcode\Gridview\Model;
use \Magento\Framework\Model\AbstractModel;
/**
 * 
 */
class Viewdata extends AbstractModel
{
	
	protected function _construct()
	{
		$this->_init('Smartcode\Gridview\Model\ResourceModel\Viewdata');
	}
}
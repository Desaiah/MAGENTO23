<?php
namespace Smartcode\Gridview\Model\ResourceModel\Viewdata;
/**
 * 
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	
	protected function _construct()
	{
		$this->_init(
			'Smartcode\Gridview\Model\Viewdata',
			'Smartcode\Gridview\Model\ResourceModel\Viewdata'
		);
	}
}
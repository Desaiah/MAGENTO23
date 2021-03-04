<?php
namespace Smartcode\Gridview\Model\ResourceModel;
use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * 
 */
class Viewdata extends AbstractDb
{
	
	protected function _construct()
	{
		$this->_init('grid_view','post_id');
	}
}
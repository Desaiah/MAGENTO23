<?php
namespace Smartcode\Orderlist\Controller\Order;
/**
 * 
 */
class Index extends \Magento\Framework\App\Action\Action
{
	
	public function execute(){
		$this->_view->loadlayout();
		$this->_view->renderLayout();
	}
}
?>
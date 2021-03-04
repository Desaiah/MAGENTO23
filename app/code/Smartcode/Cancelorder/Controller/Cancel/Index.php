<?php 
namespace Smartcode\Cancelorder\Controller\Cancel;  
class Index extends \Magento\Framework\App\Action\Action { 
public function execute() { 
$this->_view->loadLayout(); 
$this->_view->renderLayout(); 
} 
} 
?>
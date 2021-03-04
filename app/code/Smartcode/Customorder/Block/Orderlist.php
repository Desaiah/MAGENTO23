<?php

namespace Smartcode\Customorder\Block;

use Magento\Framework\View\Element\Template\Context;
use Smartcode\Customorder\Model\OrderdetailsFactory;
/**
 * Test List block
 */
class Orderlist extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        Context $context,
        OrderdetailsFactory $test
    ) {
        $this->_test = $test;
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Simple Custom Module List Page'));
        
        return parent::_prepareLayout();
    }

    public function getTestCollection()
    {
        $test = $this->_test->create();        
        $collection = $test->getCollection();
        return $collection;
    }
}
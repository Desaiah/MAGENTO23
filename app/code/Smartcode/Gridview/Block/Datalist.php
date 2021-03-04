<?php

namespace Smartcode\Gridview\Block;

use Magento\Framework\View\Element\Template\Context;
use Smartcode\Gridview\Model\ViewDataFactory;
/**
 * Test List block
 */
class Datalist extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        Context $context,
        ViewdataFactory $test
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
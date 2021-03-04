<?php
namespace Desaiah\Preorder\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

/**
 * Adminhtml cms blocks content block
 */
class Preorder extends Container
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_blockGroup = 'Desaiah_Preorder';
        $this->_controller = 'adminhtml_block';
        $this->_headerText = __('Product Preorder');
        $this->_addButtonLabel = __('Add New Preorder');
        parent::_construct();
    }
}
<?php

namespace Desaiah\Preorder\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Registry;

abstract class Preorder extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Desaiah_Preorder::preorder';

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     */
    public function __construct(Context $context, Registry $coreRegistry)
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param Page $resultPage
     * @return Page
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Desaiah_Preorder::preorder')
            ->addBreadcrumb(__('Desaiah'), __('Desaiah'))
            ->addBreadcrumb(__('Manage Preorder'), __('Manage Preorder'));
        return $resultPage;
    }
}

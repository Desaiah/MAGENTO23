<?php

namespace Desaiah\Preorder\Controller\Adminhtml\Preorder;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    const ADMIN_RESOURCE = 'Desaiah_Preorder::index';

    /**
     * @var PageFactory
     */
    protected $resultPagee;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return void
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Desaiah_Preorder::preorder');
        $resultPage->addBreadcrumb(__('Desaiah'), __('Desaiah'));
        $resultPage->addBreadcrumb(__('Manage Preorder'), __('Manage Preorder'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Preorder'));

        return $resultPage;
    }
}

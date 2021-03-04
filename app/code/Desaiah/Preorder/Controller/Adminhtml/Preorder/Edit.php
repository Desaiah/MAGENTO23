<?php
namespace Desaiah\Preorder\Controller\Adminhtml\Preorder;

use Desaiah\Preorder\Controller\Adminhtml\Preorder;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Desaiah\Preorder\Model\PreorderFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Preorder implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var PreorderFactory
     */
    private $preorderFactory;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        PreorderFactory $preorderFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->preorderFactory = $preorderFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit Preorder
     *
     * @return ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('preorder_id');
        $model = $this->preorderFactory->create();

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This preorder no longer exists.'));
                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('desaiah_preorder', $model);

        // 5. Build edit form
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Preorder') : __('New Preorder'),
            $id ? __('Edit Preorder') : __('New Preorder')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Preorder'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getName() : __('New Preorder'));
        return $resultPage;
    }
}

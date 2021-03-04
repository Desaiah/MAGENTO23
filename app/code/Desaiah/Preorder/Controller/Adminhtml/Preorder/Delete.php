<?php

namespace Desaiah\Preorder\Controller\Adminhtml\Preorder;

use Exception;
use Desaiah\Preorder\Model\PreorderRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;

class Delete extends Action
{
    /**
     * @var ResourcePreorder
     */
    protected $preorderRepository;

    /**
     * Delete constructor.
     * @param Context $context
     * @param PreorderRepository $preorderRepository
     */
    public function __construct(
        Context $context,
        preorderRepository $preorderRepository
    ) {
        $this->preorderRepository = $preorderRepository;
        parent::__construct($context);
    }
    /**
     * Delete action
     *
     * @return Redirect
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('preorder_id');
        if ($id) {
            try {
                $this->preorderRepository->deleteById($id);
                $this->messageManager->addSuccess(__('The item has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['preorder_id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can\'t find a item to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}

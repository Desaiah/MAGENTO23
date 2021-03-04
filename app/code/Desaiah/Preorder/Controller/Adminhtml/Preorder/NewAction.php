<?php

namespace Desaiah\Preorder\Controller\Adminhtml\Preorder;

use Desaiah\Preorder\Controller\Adminhtml\Preorder;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;

class NewAction extends Preorder implements HttpGetActionInterface
{
    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param ForwardFactory $resultForwardFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        ForwardFactory $resultForwardFactory
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Create new CMS block
     *
     * @return ResultInterface
     */

    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}

<?php

namespace Desaiah\Preorder\Controller\Adminhtml\Preorder;

use Exception;
use Desaiah\Preorder\Model\Preorder;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Desaiah\Preorder\Api\PreorderRepositoryInterface as PreorderRepository;
use Magento\Cms\Api\PreorderRepositoryInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Desaiah\Preorder\Api\Data\PreorderInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

class InlineEdit extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Desaiah_Preorder::preorder';

    /**
     * @var PreorderRepositoryInterface
     */
    protected $preorderRepository;

    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @param Context $context
     * @param PreorderRepository $preorderRepository
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        PreorderRepository $preorderRepository,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->preorderRepository = $preorderRepository;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        /** @var Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $preorderId) {
                    /** @var Preorder $preorder */
                    $preorder = $this->preorderRepository->getById($preorderId);
                    try {
                        $preorder->setData(array_merge($preorder->getData(), $postItems[$preorderId]));
                        $this->preorderRepository->save($preorder);
                    } catch (Exception $e) {
                        $messages[] = $this->getErrorWithPreorderId(
                            $preorder,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add preorder title to error message
     *
     * @param PreorderInterface $preorder
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithPreorderId(PreorderInterface $preorder, $errorText)
    {
        return '[Preorder ID: ' . $preorder->getId() . '] ' . $errorText;
    }
}

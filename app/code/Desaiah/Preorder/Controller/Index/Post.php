<?php

namespace Desaiah\Preorder\Controller\Index;

use Exception;
use Desaiah\Preorder\Api\PreorderRepositoryInterface;
use Desaiah\Preorder\Helper\Data as HelperData;
use Desaiah\Preorder\Model\PreorderFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

class Post extends Action
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var PreorderFactory
     */
    protected $preorderFactory;

    /**
     * @var HelperData $helperData
     */
    protected $helperData;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * Post constructor.
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     * @param PreorderFactory $preorderFactory
     * @param preorderRepositoryInterface $preorderRepository
     * @param HelperData $helperData
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        PreorderFactory $preorderFactory,
        LoggerInterface $logger,
        PreorderRepositoryInterface $preorderRepository,
        HelperData $helperData
    ) {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->preorderFactory = $preorderFactory;
        $this->preorderRepository = $preorderRepository;
        $this->helperData = $helperData;
        $this->logger = $logger;
    }

    /**
     * @return ResponseInterface|ResultInterface|void
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $post = $this->getRequest()->getPostValue();
        $product = $this->helperData->getProductBySku($post['sku']);
        $preorder = $this->preorderFactory->create();

        if (!$post && !$product->getId()) {
            $this->_redirect($this->_redirect->getRefererUrl());
            return;
        }

        try {
            $post ['status'] = 1;

            $preorder->setData($post);
            $this->preorderRepository->save($preorder);

            try {
                $this->helperData->sendCustomerEmail($post);
            } catch (Exception $e) {
                $this->logger->error($e->getMessage());
            }

            if ($this->helperData->isEmailSendToAdmin()) {
                try {
                    $this->helperData->sendAdminEmail($post);
                } catch (Exception $e) {
                    $this->logger->error($e->getMessage());
                }
            }
            $this->messageManager->addSuccess(__('Thank you for preorder. '));
            $this->_redirect($this->_redirect->getRefererUrl());
            return;
        } catch (Exception $e) {
            $this->messageManager->addError(__('We can\'t process your preorder right now. Sorry.'));
            $this->_redirect($this->_redirect->getRefererUrl());
            return;
        }
    }
}

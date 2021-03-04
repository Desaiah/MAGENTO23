<?php
namespace Desaiah\Preorder\Controller\Adminhtml\Preorder;

use Exception;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Magento\Backend\App\Action\Context;
use Desaiah\Preorder\Api\PreorderRepositoryInterface;
use Desaiah\Preorder\Model\Preorder;
use Desaiah\Preorder\Model\PreorderFactory;
use Desaiah\Preorder\Helper\Data as HelperData;
use Magento\Framework\App\Area;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\MailException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Framework\Mail\Template\TransportBuilder as TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface as  InlineTranslation;
use Psr\Log\LoggerInterface;

class Save extends \Desaiah\Preorder\Controller\Adminhtml\Preorder implements HttpPostActionInterface
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var PreorderFactory
     */
    protected $preorderFactory;

    /**
     * @var preorderRepositoryInterface
     */
    protected $preorderRepository;

    /**
     * @var HelperData $helperData
     */
    protected $helperData;

    /**
     * @var TransportBuilder $transportBuilder
     */
    protected $transportBuilder;

    /**
     * @var InlineTranslation $inlineTranslation
     */
    protected $inlineTranslation;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * Save constructor.
     * @param Context $context
     * @param Registry $coreRegistry
     * @param DataPersistorInterface $dataPersistor
     * @param PreorderFactory $preorderFactory
     * @param PreorderRepositoryInterface $preorderRepository
     * @param HelperData $helperData
     * @param TransportBuilder $transportBuilder
     * @param InlineTranslation $inlineTranslation
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        DataPersistorInterface $dataPersistor,
        PreorderFactory $preorderFactory,
        PreorderRepositoryInterface $preorderRepository,
        HelperData $helperData,
        TransportBuilder $transportBuilder,
        InlineTranslation $inlineTranslation,
        LoggerInterface $logger
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->preorderFactory = $preorderFactory;
        $this->preorderRepository = $preorderRepository;
        $this->helperData = $helperData;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->logger = $logger;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (isset($data['status']) && $data['status'] === 'true') {
                $data['status'] = Preorder::STATUS_ENABLED;
            }
            if (empty($data['preorder_id'])) {
                $data['preorder_id'] = null;
            }

            /** @var Preorder $model */
            $model = $this->preorderFactory->create();

            $id = $this->getRequest()->getParam('preorder_id');
            if ($id) {
                try {
                    $model = $this->preorderRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This preorder no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            } else {
                $data['created_at'] = (date('Y-m-d H:i:s'));
            }

            $model->setData($data);

            try {
                $this->preorderRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the preorder.'));
                if ($data['send_email'] && $data['send_email'] != null) {
                    try {
                        $this->helperData->sendAdminReplyEmail($data);
                        $this->messageManager->addSuccessMessage(__('You saved the preorder & Email has been sent to customer.'));
                    } catch (Exception $e) {
                        $this->logger->error($e->getMessage());
                        $this->messageManager->addSuccessMessage(__('There is some error, email has been not sent to customer.'));
                    }
                }
                $this->dataPersistor->clear('desaiah_preorder');
                return $this->processPreorderReturn($model, $data, $resultRedirect);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the preorder.'));
            }

            $this->dataPersistor->set('desaiah_preorder', $data);
            return $resultRedirect->setPath('*/*/edit', ['preorder_id' => $id]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Process and set the Preorder return
     *
     * @param Preorder $model
     * @param array $data
     * @param ResultInterface $resultRedirect
     * @return ResultInterface
     * @throws LocalizedException
     */

    private function processPreorderReturn($model, $data, $resultRedirect)
    {
        $redirect = $data['back'] ?? 'close';

        if ($redirect ==='continue') {
            $resultRedirect->setPath('*/*/edit', ['preorder_id' => $model->getId()]);
        } else if ($redirect === 'close') {
            $resultRedirect->setPath('*/*/');
        } else if ($redirect === 'duplicate') {
            $duplicateModel = $this->preorderFactory->create(['data' => $data]);
            $duplicateModel->setId(null);
            $duplicateModel->setStatus(Preorder::STATUS_DISABLED);
            $this->preorderRepository->save($duplicateModel);
            $id = $duplicateModel->getId();
            $this->messageManager->addSuccessMessage(__('You duplicated the preorder.'));
            $this->dataPersistor->set('desaiah_preorder', $data);
            $resultRedirect->setPath('*/*/edit', ['preorder_id' => $id]);
        }
        return $resultRedirect;
    }

    /**
     * @param $data
     * @throws MailException
     * @throws NoSuchEntityException
     */
    private function sendEmail($data)
    {
        $product = $this->helperData->getProductBySku($data['sku']);
        $productName = $product->getName();
        $productUrl = $product->getProductUrl();

        echo "<pre>";
        echo $productName."<br>";
        echo $productUrl;
        die();

        $templateOptions = array('area' => Area::AREA_ADMINHTML, 'store' => $this->storeManager->getStore()->getId());
        $templateVars = array(
            'customer_name' => $data['name'],
            'message'   => $data['message'],
            'product_name' =>  $productName,
            'product_url' =>  $productUrl,
            'admin_message' => $data['admin_message']
        );

        $from = array('email' => $this->helperData->getSenderEmail(), 'name' => $this->helperData->getSenderName());
        $this->inlineTranslation->suspend();
        $to = array($data['email']);
        $transport = $this->transportBuilder->setTemplateIdentifier('preorder_reply')
            ->setTemplateOptions($templateOptions)
            ->setTemplateVars($templateVars)
            ->setFrom($from)
            ->addTo($to)
            ->getTransport();

        $transport->sendMessage();
        $this->inlineTranslation->resume();
    }
}

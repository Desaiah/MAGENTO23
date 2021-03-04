<?php

namespace Desaiah\Preorder\Block\Adminhtml\Preorder\Edit;

use Magento\Backend\Block\Widget\Context;
use Desaiah\Preorder\Api\PreorderRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var PreorderRepositoryInterface
     */
    protected $preorderRepository;

    /**
     * @param Context $context
     * @param PreorderRepositoryInterface $preorderRepository
     */
    public function __construct(
        Context $context,
        PreorderRepositoryInterface $preorderRepository
    ) {
        $this->context = $context;
        $this->preorderRepository = $preorderRepository;
    }

    /**
     * @return int|null
     * @throws LocalizedException
     */
    public function getPreorderId()
    {
        try {
            return $this->preorderRepository->getById(
                $this->context->getRequest()->getParam('preorder_id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}

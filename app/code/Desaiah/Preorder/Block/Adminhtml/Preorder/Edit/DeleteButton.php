<?php

namespace Desaiah\Preorder\Block\Adminhtml\Preorder\Edit;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getPreorderId()) {
            $data = [
                'label' => __('Delete Preorder'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\', {"data": {}})',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * @return string
     * @throws LocalizedException
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['preorder_id' => $this->getPreorderId()]);
    }
}

<?php
namespace Desaiah\Preorder\Controller\Adminhtml\Preorder;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;

class MassStatus extends Action
{
    /**
     * Update blog post(s) status action
     *
     * @return Redirect
     * @throws LocalizedException|Exception
     */
    public function execute()
    {
        $itemIds = $this->getRequest()->getParam('preorder');
        if (!is_array($itemIds) || empty($itemIds)) {
            $this->messageManager->addError(__('Please select item(s).'));
        } else {
            try {
                $status = (int) $this->getRequest()->getParam('status');
                foreach ($itemIds as $postId) {
                    $post = $this->_objectManager->get('Mage2\Preorder\Model\Preorder')->load($postId);
                    $post->setIsActive($status)->save();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been updated.', count($itemIds))
                );
            } catch (Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        return $this->resultRedirectFactory->create()->setPath('preorder/*/index');
    }
}

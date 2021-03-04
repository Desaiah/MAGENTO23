<?php

namespace Desaiah\Preorder\Model;

use Magento\Framework\Model\AbstractModel;
use Desaiah\Preorder\Api\Data\PreorderInterface;

class Preorder extends AbstractModel implements PreorderInterface
{
    /**
     * CMS block cache tag
     */
    const CACHE_TAG = 'preorder_b';

    /**#@+
     * Block's statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**#@-*/

    /**#@-*/
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'desaiah_preorder';

    /**
     * Name of object id field
     *
     * @var string
     */
    protected $_idFieldName = self::PREORDER_ID; // parent value is 'id'

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Desaiah\Preorder\Model\ResourceModel\Preorder::class);
    }

    /**
     * Prepare block's statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('New'), self::STATUS_DISABLED => __('Replied')];
    }

    /**
     * Retrieve Preorder id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::PREORDER_ID);
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return (string)$this->getData(self::NAME);
    }

    /**
     * Get Mobile Number
     *
     * @return int|null
     */
    public function getMobileNumber()
    {
        return $this->getData(self::MOBILE_NUMBER);
    }

    /**
     * Get message
     *
     * @return string|null
     */
    public function getMessage()
    {
        return $this->getData(self::MESSAGE);
    }

    /**
     * Get EMAIL
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * Get Product Id
     *
     * @return int|null
     */
    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * Get display front setting
     *
     * @return boolean|null
     */
    public function getDisplayFront()
    {
        return $this->getData(self::DISPLAY_FRONT);
    }

    /**
     * Get admin message
     *
     * @return string|null
     */
    public function getAdminMessage()
    {
        return $this->getData(self::ADMIN_MESSAGE);
    }

    /**
     * Get status
     *
     * @return boolean|null
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PreorderInterface
     */
    public function setId($id)
    {
        return $this->setData(self::PREORDER_ID, $id);
    }

    /**
     * Set Name
     *
     * @return PreorderInterface
     */
    public function setName($name)
    {
        return (string)$this->setData(self::NAME, $name);
    }

    /**
     * Set Mobile Number
     *
     * @return PreorderInterface
     */
    public function setMobileNumber($mobile_number)
    {
        return $this->setData(self::MOBILE_NUMBER, $mobile_number);
    }

    /**
     * set message
     *
     * @return PreorderInterface
     */
    public function setMessage($message)
    {
        return $this->setData(self::MESSAGE, $message);
    }

    /**
     * set EMAIL
     *
     * @return PreorderInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * set Product Id
     *
     * @return PreorderInterface
     */
    public function setProductId($product_id)
    {
        return $this->setData(self::PRODUCT_ID, $product_id);
    }

    /**
     * set display front setting
     *
     * @return PreorderInterface
     */
    public function setDisplayFront($display_front)
    {
        return $this->setData(self::DISPLAY_FRONT, $display_front);
    }

    /**
     * set admin message
     *
     * @return PreorderInterface
     */
    public function setAdminMessage($admin_message)
    {
        return $this->setData(self::ADMIN_MESSAGE, $admin_message);
    }

    /**
     * set status
     *
     * @return PreorderInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}

<?php
namespace Desaiah\Preorder\Api\Data;

/**
 * Preorder Interface
 * @api
 * @since 100.0.2
 */
interface PreorderInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const PREORDER_ID      = 'preorder_id';
    const NAME            = 'name';
    const MOBILE_NUMBER   = 'mobile_number';
    const MESSAGE         = 'message';
    const EMAIL           = 'email';
    const PRODUCT_ID      = 'product_id';
    const STATUS          = 'status';
    const DISPLAY_FRONT   = 'display_front';
    const ADMIN_MESSAGE   = 'admin_message';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get Name
     *
     * @return string
     */
    public function getName();

    /**
     * Get Mobile Number
     *
     * @return string|null
     */
    public function getMobileNumber();

    /**
     * Get message
     *
     * @return string|null
     */
    public function getMessage();

    /**
     * Get email
     *
     * @return string|null
     */
    public function getEmail();

    /**
     * Get Product Id
     *
     * @return string|null
     */
    public function getProductId();

    /**
     * Get Display in front setting
     *
     * @return string|null
     */
    public function getDisplayFront();

    /**
     * Get Admin message
     *
     * @return string|null
     */
    public function getAdminMessage();

    /**
     * Get status
     *
     * @return bool|null
     */
    public function getStatus();

    /**
     * Set ID
     *
     * @param int $id
     * @return PreorderInterface
     */
    public function setId($id);

    /**
     * Set Name
     *
     * @param string $name
     * @return PreorderInterface
     */
    public function setName($name);

    /**
     * Set MobileNumber
     *
     * @param string $mobile_number
     * @return PreorderInterface
     */
    public function setMobileNumber($mobile_number);

    /**
     * Set message
     *
     * @param string $message
     * @return PreorderInterface
     */
    public function setMessage($message);

    /**
     * Set Email
     *
     * @param string $email
     * @return PreorderInterface
     */
    public function setEmail($email);

    /**
     * set ProductId
     *
     * @param int $product_id
     * @return PreorderInterface
     */
    public function setProductId($product_id);

    /**
     * Set Display Front setting
     *
     * @param bool|int $display_front
     * @return PreorderInterface
     */
    public function setDisplayFront($display_front);

    /**
     * Set Admin Message
     *
     * @param string $admin_message
     * @return PreorderInterface
     */
    public function setAdminMessage($admin_message);

    /**
     * Set Status
     *
     * @param bool|int $status
     * @return PreorderInterface
     */
    public function setStatus($status);
}

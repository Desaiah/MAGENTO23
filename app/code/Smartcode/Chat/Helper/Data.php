<?php
namespace Smartcode\Chat\Helper;

/**
 * 
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
	
	public function __construct(\Magento\Framework\App\Helper\Context $context)
	{
		parent::__construct($context);
	}

	public function getStatus(){
		return $this->scopeConfig->getValue('contact/whatsapp_chat/status', 
                        \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
	}

	public function getPhone(){
		return $this->scopeConfig->getValue('contact/whatsapp_chat/phone_number', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
	}

	public function getMessage(){
		return $this->scopeConfig->getValue('contact/whatsapp_chat/message', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
	}

}
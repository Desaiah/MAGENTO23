<?php
namespace Megnor\ShopByBrand\Block;
class Index extends \Magento\Framework\View\Element\Template
{
    protected $_brandFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
         \Megnor\ShopByBrand\Model\BrandFactory $brandFactory
    ) 
    {
    	 $this->_brandFactory = $brandFactory;
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->_addBreadcrumbs();
        return parent::_prepareLayout();
    }
    
    /**
     * Prepare breadcrumbs
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return void
     */
    protected function _addBreadcrumbs()
    {
        if ($this->_scopeConfig->getValue('web/default/show_cms_breadcrumbs', ScopeInterface::SCOPE_STORE)
            && ($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs'))
        ) {
            $breadcrumbsBlock->addCrumb(
                'home',
                [
                    'label' => __('Home'),
                    'title' => __('Go to Home Page'),
                    'link' => $this->_storeManager->getStore()->getBaseUrl()
                ]
            );
            $breadcrumbsBlock->addCrumb(
                'brand',
                [
                    'label' => __('Brand'),
                    'title' => __(sprintf('Go to Brand Home Page'))
                ]
            );
        }
    }
    public function getBrands(){
		$collection = $this->_brandFactory->create()->getCollection();
		$collection->addFieldToFilter('is_active' , \Megnor\ShopByBrand\Model\Status::STATUS_ENABLED);
		$collection->setOrder('name' , 'ASC');
		$charbrandArray = array();
		foreach($collection as $brand)
		{	
			$name = trim($brand->getName());
			$charbrandArray[strtoupper($name[0])][] = $brand;
		}
    	return $charbrandArray;
    }
     public function getImageMediaPath(){
    	return $this->getUrl('pub/media',['_secure' => $this->getRequest()->isSecure()]);
    }
     public function getFeaturedBrands(){
		$collection = $this->_brandFactory->create()->getCollection();
		$collection->addFieldToFilter('is_active' , \Megnor\ShopByBrand\Model\Status::STATUS_ENABLED);
		$collection->addFieldToFilter('featured' , \Megnor\ShopByBrand\Model\Status::STATUS_ENABLED);
		$collection->setOrder('sort_order' , 'ASC');
    	return $collection;
    }
}
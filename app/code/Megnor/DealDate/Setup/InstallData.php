<?php
namespace Megnor\DealDate\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Config;
use Magento\Eav\Model\Entity\Attribute\Frontend\Datetime as DateFrontendModel;
use Magento\Eav\Model\Entity\Attribute\Backend\Datetime as DateBackendModel;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;
   
    public function __construct(EavSetupFactory $eavSetupFactory, Config $eavConfig)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
    }
  
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
  
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'deal_from_date',
            [
                'group' => 'Deal of the Day',
                'type' => 'datetime',
                'backend' => DateBackendModel::class,
                'frontend'=> DateFrontendModel::class,
                'label' => 'Deal Start Date',
                'input' => 'date',
                'class' => '',
                'source' => '',
                'global' => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'simple,configurable,virtual,bundle,downloadable'
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'deal_to_date',
            [
                'group' => 'Deal of the Day',
                'type' => 'datetime',
                'backend' => DateBackendModel::class,
                'frontend'=> DateFrontendModel::class,
                'label' => 'Deal End Date',
                'input' => 'date',
                'class' => '',
                'source' => '',
                'global' => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'simple,configurable,virtual,bundle,downloadable'
            ]
        );

    }
}
<?php

namespace Desaiah\Preorder\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.0') < 0) {
            $table = $setup->getConnection()->newTable(
                $setup->getTable('desaiah_preorder')
            )->addColumn(
                'preorder_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'preorder Id'
            )->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Customer Name'
            )->addColumn(
                'email',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Customer Email'
            )->addColumn(
                'mobile_number',
                \Magento\Framework\DB\Ddl\Table::TYPE_BIGINT,
                15,
                [],
                'Mobile Number'
            )->addColumn(
                'message',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Message'
            )->addColumn(
                'sku',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Product Sku'
            )->addColumn(
                'status',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                2,
                [],
                'Status'
            )->addColumn(
                'display_front',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                2,
                [],
                'Display in Front'
            )->addColumn(
                'admin_message',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Admin Message'
            )->addColumn(
                'created_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                'Created At'
            )->addIndex(
                $setup->getIdxName(
                    $setup->getTable('desaiah_preorder'),
                    ['name', 'email'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['name', 'email'],
                ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT]
            )->setComment(
                'Desaiah Preorder'
            );
            $setup->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}

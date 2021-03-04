<?php
/**
* Copyright © 2016 Magento. All rights reserved.
* See COPYING.txt for license details.
*/

namespace Smartcode\Dbcollection\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use \Magento\Framework\DB\Ddl\Table;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
    * {@inheritdoc}
    * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
    */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
          /**
          * Create table 'greeting_message'
          */
          $table = $setup->getConnection()
              ->newTable($setup->getTable('grid_collection'))
              ->addColumn(
                  'id',
                  \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                  null,
                  ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                  'ID'
              )
              ->addColumn(
                  'title',
                  \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                  null,
                  ['nullable' => false],
                    'title'
              )
              ->addColumn(
                  'author',
                  \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                  null,
                  ['nullable' => false,],
                    'author'
              )
              ->addColumn(
                  'content',
                  \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                  null,
                  ['nullable' => false],
                    'content'
              )
              ->addColumn(
                  'created_at',
                  \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                  null,
                  ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'created_at'
              )->setComment("Smartcode Grid view table");
          $setup->getConnection()->createTable($table);
      }
}
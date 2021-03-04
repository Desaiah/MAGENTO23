<?php

namespace Smartcode\Gridview\Setup;

use \Magento\Framework\Setup\UpgradeDataInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\ModuleDataSetupInterface;


class UpgradeData implements UpgradeDataInterface
{

    /**
     * Creates sample blog posts
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if ($context->getVersion()
            && version_compare($context->getVersion(), '1.0.2') < 0
        ) {
            $tableName = $setup->getTable('grid_view');

            $data = [
                [
                    'title' => 'Post 3 Title',
                    'content' => 'Content of the first post.',
                ],
                [
                    'title' => 'Post 4 Title',
                    'content' => 'Content of the second post.',
                ],
                [
                    'title' => 'Post 5 Title',
                    'content' => 'Content of the first post.',
                ],
                [
                    'title' => 'Post 6 Title',
                    'content' => 'Content of the first post.',
                ],
                [
                    'title' => 'Post  Title',
                    'content' => 'Content of the first post.',
                ],
            ];

            $setup
                ->getConnection()
                ->insertMultiple($tableName, $data);
        }

        $setup->endSetup();
    }
}

<?php

namespace Mastering\SampleModule\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()->newTable($installer->getTable('mastering_sample_item'))
            ->addColumn('id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['identity' => true, 'nullable' => false, 'primary' => true], 'Item ID')
            ->addColumn('name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => false], 'Item Name')
            ->addColumn('stock', \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN, [], ['nullable' => false], 'Stock Status')
            ->addColumn('quantity', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, [], ['nullable' => false], 'Item Quantity')
            ->addIndex($installer->getIdxName('mastering_sample_item', ['name']), ['name'])
            ->setComment('Sample Items');

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}

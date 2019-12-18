<?php
/**
 * @author Ceymox
 * @copyright Copyright (c) 2019 Ceymox
 * @package Ceymox_OrderList
 */

namespace Ceymox\OrderList\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Install table
     *
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $contextInterface = $context;
        $installer->startSetup();
       
        $table = $installer->getConnection()->newTable(
            $installer->getTable('ceymox_list')
        )->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'ID'
        )->addColumn(
            'purchase_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => false],
            'Purchase ID'
        )->addColumn(
            'customer_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Name'
         )->addColumn(
            'customer_email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Email'
        )->addColumn(
            'total_price',
            \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
            null,
            ['nullable' => false],
            'Price'
         )->addColumn(
            'total_qty',
            \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
            255,
            ['nullable' => false],
            'Qty'
         )->addColumn(
            'order_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            255,
            ['nullable' => false,'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
            'Time'
         )->addColumn(
            'tax',
            \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
            255,
            ['nullable' => false],
            'Tax'
         )->addColumn(
            'discount',
            \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
            255,
            ['nullable' => false],
            'Discount'
         )->addColumn(
            'shipping_charge',
            \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
            255,
            ['nullable' => false],
            'Charge'
        )->addIndex(
            $installer->getIdxName('ceymox_list', ['customer_name']),
            ['customer_name']
        )->setComment('Order Table');
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}

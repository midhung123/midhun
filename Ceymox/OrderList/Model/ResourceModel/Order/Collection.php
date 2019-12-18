<?php
/**
 * @author Ceymox
 * @copyright Copyright (c) 2019 Ceymox
 * @package Ceymox_OrderList
 */

namespace Ceymox\OrderList\Model\ResourceModel\Order;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Ceymox\OrderList\Model\Order', 'Ceymox\OrderList\Model\ResourceModel\Order');
        $this->_idFieldName = 'order_id';
    }
}

<?php
/**
 * @author Ceymox
 * @copyright Copyright (c) 2019 Ceymox
 * @package Ceymox_OrderList
 */

namespace Ceymox\OrderList\Model;

use Magento\Framework\Exception\LocalizedException as CoreException;

class Order extends \Magento\Framework\Model\AbstractModel
{
   /**
    * @return void
    */
    public function _construct()
    {
        $this->_init('Ceymox\OrderList\Model\ResourceModel\Order');
    }
}

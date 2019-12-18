<?php
/**
 * @author Ceymox
 * @copyright Copyright (c) 2019 Ceymox
 * @package Ceymox_OrderList
 */

namespace Ceymox\OrderList\Model\Data;

use Ceymox\OrderList\Api\Data\OrderInterface;

class Order extends \Magento\Framework\Api\AbstractExtensibleObject implements OrderInterface
{
     /**
     * Get Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->_get(self::ID);
    }
    /**
     * Get Id
     *
     * @return int
     */
    public function getPurchaseId()
    {
        return $this->_get(self::PURCHASE_ID);
    }

    /**
     * Get Name
     *
     * @return string|null
     */
    public function getCustomerName()
    {
        return $this->_get(self::NAME);
    }
    
    /**
     * Get Email
     *
     * @return string|null
     */
    public function getCustomerEmail()
    {
        return $this->_get(self::EMAIL);
    }
    
    /**
     * Get Total
     *
     * @return decimal|null
     */
    public function getTotalPrice()
    {
        return $this->_get(self::PRICE);
    }
    
    /**
     * Get Qty
     *
     * @return decimal|null
     */
    public function getTotalQty()
    {
        return $this->_get(self::QTY);
    }
    
    /**
     * Get Time
     *
     * @return timestamp|null
     */
    public function getCreatedAt()
    {
        return $this->_get(self::TIME);
    }
    
    /**
     * Get Tax
     *
     * @return decimal|null
     */
    public function getTaxPrice()
    {
        return $this->_get(self::TAX);
    }
    
    /**
     * Get Discount
     *
     * @return decimal|null
     */
    public function getDiscountPrice()
    {
        return $this->_get(self::DISCOUNT);
    }
    
    /**
     * Get Charge
     *
     * @return decimal|null
     */
    public function getShippingCharge()
    {
        return $this->_get(self::CHARGE);
    }

    /**
     * Set Name
     *
     * @param string $name
     * @return $this
     */
    public function setCustomerName($name)
    {
        return $this->setData(self::NAME, $name);
    }
     
    /**
     * Set Email
     *
     * @param string $email
     * @return $this
     */
    public function setCustomerEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }


    /**
     * Set Price
     *
     * @param decimal $price
     * @return $this
     */
    public function setTotalPrice($price)
    {
        return $this->setData(self::PRICE, $price);
    }
     
    /**
     * Set Qty
     *
     * @param decimal $qty
     * @return $this
     */
    public function setTotalQty($qty)
    {
        return $this->setData(self::QTY, $qty);
    }
     
    /**
     * Set Time
     *
     * @param timestamp $time
     * @return $this
     */
    public function setCreatedAt($time)
    {
        return $this->setData(self::TIME, $time);
    }
     
    /**
     * Set Tax
     *
     * @param decimal $tax
     * @return $this
     */
    public function setTaxPrice($tax)
    {
        return $this->setData(self::TAX, $tax);
    }
     
    /**
     * Set Discount
     *
     * @param decimal $discount
     * @return $this
     */
    public function setDiscountPrice($discount)
    {
        return $this->setData(self::DISCOUNT, $discount);
    }
     
    /**
     * Set Charge
     *
     * @param decimal $charge
     * @return $this
     */
    public function setShippingCharge($charge)
    {
        return $this->setData(self::CHARGE, $charge);
    }

   
    /**
     * Set PurchaseID
     *
     * @param int $purchaseid
     * @return $this
     */
    public function setPurchaseId($purchaseid)
    {
        return $this->setData(self::PURCHASE_ID, $purchaseid);
    }
/**
     * Set ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }
}

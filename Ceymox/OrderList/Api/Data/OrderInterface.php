<?php
/**
 * @author Ceymox
 * @copyright Copyright (c) 2019 Ceymox
 * @package Ceymox_OrderList
 */

namespace Ceymox\OrderList\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;
 
interface OrderInterface extends ExtensibleDataInterface
{
    const ID             = 'order_id';
    const PURCHASE_ID    = 'purchase_id';
    const NAME           = 'customer_name';
    const EMAIL          = 'customer_email';
    const PRICE          = 'total_price';
    const QTY            = 'total_qty';
    const TIME           = 'order_time';
    const TAX            = 'tax';
    const DISCOUNT       = 'discount';
    const CHARGE         = 'shipping_charge';
    


     /**
     * @return int
     */
    public function getId();
   /**
     * Get PurchaseId
     *
     * @return string|null
     */
    public function getPurchaseId();
 
    /**
     * Get Name
     *
     * @return string|null
     */
    public function getCustomerName();

     /**
     * Get Email
     *data insertion in magento using api
     * @return string|null
     */
    public function getCustomerEmail();

    /**
     * Get Total
     *
     * @return decimal
     */ 
    public function getTotalPrice();
 
    /**
     * Get Qty
     *
     * @return decimal|null
     */
    public function getTotalQty();
 
    /**
     * Get Time
     *
     * @return timestamp|null
     */
    public function getCreatedAt();
 
    /**
     * Get Tax
     *
     * @return decimal|null
     */
    public function getTaxPrice();
 
    /**
     * Get Discount
     *
     * @return decimal|null
     */
    public function getDiscountPrice();
 
    /**
     * Get Shipping Charge
     *
     * @return decimal|null
     */
    public function getShippingCharge();
   
     /**
     * @param int $id
     * @return OrderInterface
     */
    public function setId($id);


    /**
     * @param int $purchaseid
     * @return OrderInterface
     */
    public function setPurchaseId($purchaseid);

    /**
     * @param $name
     * @return OrderInterface
     */
    public function setCustomerName($name);
    
    /**
     * @param $email
     * @return OrderInterface
     */
    public function setCustomerEmail($email);

    /**
     * @param decimal $price
     * @return OrderInterface
     */
    public function setTotalPrice($price);

    /**
     * @param decimal $qty
     * @return OrderInterface
     */
    public function setTotalQty($qty);

    /**
     * @param timestamp $time
     * @return OrderInterface
     */
    public function setCreatedAt($time);

    /**
     * @param decimal $tax
     * @return OrderInterface
     */
    public function setTaxPrice($tax);

    /**
     * @param decimal $discount
     * @return OrderInterface
     */
    public function setDiscountPrice($discount);

    /**
     * @param decimal $shipping_charge
     * @return OrderInterface
     */
    public function setShippingCharge($charge);
}

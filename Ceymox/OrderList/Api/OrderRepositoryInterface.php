<?php
/**
 * @author Ceymox
 * @copyright Copyright (c) 2019 Ceymox
 * @package Ceymox_OrderList
 */

namespace Ceymox\OrderList\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Ceymox\OrderList\Api\Data\OrderInterface;

interface OrderRepositoryInterface
{
    /**
     * @param int $order_id
     * @return \Ceymox\OrderList\Api\Data\OrderInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($order_id);

    /**
     * Save Data
     *
     * @param \Ceymox\OrderList\Api\Data\OrderInterface
     * @return \Ceymox\OrderList\Api\Data\OrderInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(OrderInterface $orderdata);

    /**
     * Delete the item by order_id id
     * @param $order_id
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($order_id);

    /**
     * Load data collection by given search criteria
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Ceymox\OrderList\Api\Data\OrderSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
    
     /**
     * @param string $order
     * @return int
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getByOrder($order);
}

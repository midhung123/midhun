<?php
/**
 * @author Ceymox
 * @copyright Copyright (c) 2019 Ceymox
 * @package Ceymox_OrderList
 */

namespace Ceymox\OrderList\Api\Data;

interface OrderSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get Order Data.
     *
     * @return \Ceymox\OrderList\Api\Data\OrderInterface[]
     */
    public function getItems();

    /**
     * Set Order Data.
     *
     * @param \Ceymox\OrderList\Api\Data\OrderInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

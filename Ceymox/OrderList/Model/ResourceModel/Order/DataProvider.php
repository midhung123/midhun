<?php
/**
 * @author Ceymox Team
 * @copyright Copyright (c) 2019 Ceymox (https://ceymox.com)
 * @package Ceymox_OrderList
 */
namespace Ceymox\OrderList\Model\ResourceModel\Order;

use Ceymox\OrderList\Model\ResourceModel\Order\Grid\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
 
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    public $loadedData;
    public $storeManager;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $orderCollectionFactory,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $orderCollectionFactory->create();
        $this->storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
 
    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        foreach ($items as $item) {
            $requestData = $item->getData();
            $this->loadedData[$item->getId()]['order_details'] = $requestData;
        }
        return $this->loadedData;
    }
}

<?php
/**
 * @author Ceymox
 * @copyright Copyright (c) 2019 Ceymox
 * @package Ceymox_OrderList
 */
 
namespace Ceymox\OrderList\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Ceymox\OrderList\Api\Data;

class OrderRepository implements \Ceymox\OrderList\Api\OrderRepositoryInterface
{
    /**
     * @var orderFactory
     */
    private $orderFactory;
    /**
     * @var ResourceModel\Order
     */
    private $orderResource;
    /**
     * @var \Ceymox\OrderList\Api\Data\OrderInterfaceFactory
     */
    private $orderpDataFactory;
    /**
     * @var \Magento\Framework\Api\DataObjectHelper
     */
    private $dataObjectHelper;
    /**
     * @var \Magento\Framework\Api\ExtensibleDataObjectConverter
     */
    private $dataObjectConverter;
    /**
     * @var Data\OrderSearchResultInterfaceFactory
     */
    private $searchResultFactory;
    /**
     * @var \Magento\Framework\Reflection\DataObjectProcessor
     */
    private $dataObjectProcessor;

    /**
     * OrderRepository constructor.
     * @param OrderFactory $orderFactory
     * @param ResourceModel\order $orderResource
     * @param \Ceymox\OrderList\Api\Data\OrderInterfaceFactory $orderDataFactory
     * @param \Magento\Framework\Api\DataObjectHelper $dataObjectHelper
     * @param \Magento\Framework\Api\ExtensibleDataObjectConverter $dataObjectConverter
     * @param Data\OrderSearchResultInterfaceFactory $searchResultFactory
     * @param \Magento\Framework\Reflection\DataObjectProcessor $dataObjectProcessor
     */
    public function __construct(
        \Ceymox\OrderList\Model\OrderFactory $orderFactory,
        \Ceymox\OrderList\Model\ResourceModel\Order $orderResource,
        \Ceymox\OrderList\Api\Data\OrderInterfaceFactory $orderDataFactory,
        \Magento\Framework\Api\DataObjectHelper $dataObjectHelper,
        \Magento\Framework\Api\ExtensibleDataObjectConverter $dataObjectConverter,
        \Ceymox\OrderList\Api\Data\OrderSearchResultsInterfaceFactory $searchResultFactory,
        \Magento\Framework\Reflection\DataObjectProcessor $dataObjectProcessor
    ) {
        $this->orderFactory = $orderFactory;
        $this->orderResource = $orderResource;
        $this->orderDataFactory = $orderDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataObjectConverter = $dataObjectConverter;
        $this->searchResultFactory = $searchResultFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
    }

    /**
     * @param int $orderId
     * @return \Ceymox\OrderList\Api\Data\OrderInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($orderId)
    {
        $orderObj = $this->orderFactory->create();
        $this->orderResource->load($orderObj, $orderId);
        if (!$orderObj->getId()) {
            throw new NoSuchEntityException(__('Item with id "%1" does not exist.', $orderId));
        }
        $data = $this->orderDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $data,
            $sorderObj->getData(),
            'Ceymox\OrderList\Api\Data\OrderInterface'
        );
        $data->setId($orderObj->getorderId());
        return $data;
    }

    /**
     * Save Order Data
     *
     * @param \Ceymox\OrderList\Api\Data\OrderInterface
     * @return \Ceymox\OrderList\Api\Data\OrderInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\OrderInterface $order)
    {
        $orderData = $this->dataObjectConverter->toNestedArray(
            $order,
            [],
            'Ceymox\OrderList\Api\Data\OrderInterface'
        );
        $orderModel = $this->orderFactory->create(['data'=>$orderData]);
        try {
            $orderModel->setorderId($order->getId());
            $this->orderResource->save($orderModel);
            if ($order->getId()) {
                $order = $this->getById($order->getId());
            } else {
                $order->setId($orderModel->getId());
            }
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__('Could not save the data: %1', $exception->getMessage()));
        }
    }

    /**
     * Delete the item by signup id
     * @param $signupId
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($orderId)
    {
        $orderObj = $this->orderFactory->create();
        $this->orderResource->load($orderObj, $orderId);
        $this->orderResource->delete($orderObj);
        if ($orderObj->isDeleted()) {
            return true;
        }
        return false;
    }

     /**
      * Load data collection by given search criteria
      *
      * @param SearchCriteriaInterface $searchCriteria
      * @return \Ceymox\OrderList\Api\Data\OrderSearchResultInterface
      */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $searchResults = $this->searchResultFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $collection = $this->signupFactory->create()->getCollection();
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                /** if no condition is set then it will take eq condition by default */
                $condition = $filter->getConditionType() ?:'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $searchCriteria->getSortOrders();
        if ($sortOrders) {
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrders->getField(),
                    ($sortOrders->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());
        $orders = [];
        foreach ($collection as $orderModel) {
            $orderData = $this->orderDataFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $orderData,
                $orderModel->getData(),
                'Ceymox\OrderList\Api\Data\OrderInterface'
            );
            $orders[] = $this->dataObjectProcessor->buildOutputDataArray(
                $orderData,
                'Ceymox\OrderList\Api\Data\OrderInterface'
            );
        }
        $searchResults->setItems($orders);
        return $searchResults;
    }
 public function getByorder($order)
    {
        $orderObj = $this->orderFactory->create();
        $this->orderResource->load($orderObj, $order, 'order');
        if (!$orderObj->getId()) {
            return 0;
        }
        return $orderObj->getOrderId();
    }
}

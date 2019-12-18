<?php
namespace Ceymox\OrderList\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ObjectManager;
class OrderObserver implements ObserverInterface
{
protected $_order;
protected $_dataFactory;
public function __construct(
 \Ceymox\OrderList\Api\Data\OrderInterface $order,
   \Ceymox\OrderList\Api\Data\OrderInterfaceFactory $orderFactory,
        \Ceymox\OrderList\Api\OrderRepositoryInterface $orderRepository,
 \Ceymox\OrderList\Model\ResourceModel\Order $orderResource,
  \Ceymox\OrderList\Api\Data\OrderInterface $orderDataFactory
) {
    $this->orderFactory = $orderFactory;
    $this->_order = $order;
    $this->orderResource = $orderResource;
    $this->orderDataFactory = $orderDataFactory;
     $this->orderRepository = $orderRepository;
}
/**
 *
 * @param \Magento\Framework\Event\Observer $observer
 * @return void
*/
public function execute(\Magento\Framework\Event\Observer $observer)
{
  $order           = $observer->getEvent()->getOrder();
  $purchase_id     = $order->getIncrementId();
  $customer_name   = $order->getCustomerName();
  $customer_email  = $order->getCustomerEmail();
  $total_price     = $order->getSubtotal();
  $total_qty       = $order->getTotalQtyOrdered();
  $order_time      = $order->getCreatedAt();
  $tax             = $order->getTaxAmount();
  $discount        = $order->getDiscountAmount();
  $shipping_charge = $order->getShippingAmount();

        /*echo $purchase_id;
        echo $customer_name;
        echo $customer_email;
        echo $total_price;
        echo $total_qty;
        echo $order_time;
        echo $tax;
        echo $discount;
        echo $shipping_charge;
        exit();*/

       $orderModel = $this->orderFactory->create();
       $orderModel->setPurchaseId($purchase_id);
       $orderModel->setCustomerName($customer_name);
       $orderModel->setCustomerEmail($customer_email);
       $orderModel->setTotalPrice($total_price);
       $orderModel->setTotalQty($total_qty);
       $orderModel->setCreatedAt($order_time);
       $orderModel->setTaxPrice($tax);
       $orderModel->setDiscountPrice($discount);
       $orderModel->setShippingCharge($shipping_charge);
       $this->orderRepository->save($orderModel);
   
 }
}

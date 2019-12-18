<?php
/**
 * @author Ceymox Team
 * @copyright Copyright (c) 2019 Ceymox (https://ceymox.com)
 * @package Ceymox_OrderList
 */

namespace Ceymox\OrderList\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class Price extends Column
{
    public function prepareDataSource(array $dataSource)
 {
    if (isset($dataSource['data']['items'])) {
        $store = $this->storeManager->getStore(
            $this->context->getFilterParam('store_id', \Magento\Store\Model\Store::DEFAULT_STORE_ID)
        );
        $currency = $this->localeCurrency->getCurrency($store->getBaseCurrencyCode());

        $fieldName = $this->getData('name');
        foreach ($dataSource['data']['items'] as & $item) {
            if (isset($item[$fieldName])) {
                $item[$fieldName] = $currency->toCurrency(sprintf("%f", $item[$fieldName]));
            }
        }
    }

    return $dataSource;
}
}

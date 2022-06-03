<?php

namespace AdvancedCoder\ProductTypes\Api;

interface ProductTypesSearchResultInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \AdvancedCoder\ProductTypes\Api\Data\ProductTypesInterface[]
     */
    public function getItems();

    /**
     * @param \AdvancedCoder\ProductTypes\Api\Data\ProductTypesInterface[]
     * @return void
     */
    public function setItems(array $items);
}

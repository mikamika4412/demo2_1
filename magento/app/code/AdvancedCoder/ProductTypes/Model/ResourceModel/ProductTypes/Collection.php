<?php

namespace AdvancedCoder\ProductTypes\Model\ResourceModel\ProductTypes;

use AdvancedCoder\ProductTypes\Api\Data\ProductTypesInterface;
use AdvancedCoder\ProductTypes\Model\ProductTypes;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use AdvancedCoder\ProductTypes\Model\ResourceModel\ProductTypes as ProductTypesResource;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init(ProductTypes::class, ProductTypesResource::class);
    }

    /**
     * Convert to option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return $this->_toOptionArray(ProductTypesInterface::ID, ProductTypesInterface::TYPE);
    }
}

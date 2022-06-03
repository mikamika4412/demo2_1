<?php

namespace AdvancedCoder\ProductTypes\Model;

use AdvancedCoder\ProductTypes\Api\Data\ProductTypesInterface;
use Magento\Framework\Model\AbstractModel;

class ProductTypes extends AbstractModel implements ProductTypesInterface
{

    protected function _construct()
    {
        parent::_init('AdvancedCoder\ProductTypes\Model\ResourceModel\ProductTypes');
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->getData(ProductTypesInterface::TYPE);
    }

    /**
     * @param string $type
     * @return void
     */
    public function setType(string $type): void
    {
        $this->setData(ProductTypesInterface::TYPE, $type);
    }

    /**
     * @return mixed|null
     */
    public function getId()
    {
        return $this->_getData('entity_id');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setId($value)
    {
        $this->setData('entity_id', $value);
        return $this;
    }

}

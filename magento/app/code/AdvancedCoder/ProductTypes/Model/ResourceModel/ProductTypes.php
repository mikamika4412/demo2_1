<?php

namespace AdvancedCoder\ProductTypes\Model\ResourceModel;

use AdvancedCoder\ProductTypes\Api\Data\ProductTypesInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class ProductTypes extends AbstractDb
{
    public const TABLE_NAME = 'advanced_coder_product_types';

    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, ProductTypesInterface::ID);
    }
}
